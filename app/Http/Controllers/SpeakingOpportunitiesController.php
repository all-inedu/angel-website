<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpeakingOpportunities;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class SpeakingOpportunitiesController extends Controller
{
    public function index(){
        return view('admin.speaking_opportunities.index');
    }

    public function getSpeakingOpportunities(Request $request){
        if ($request->ajax()) {
            $data = SpeakingOpportunities::orderBy('is_highlight', 'desc')->orderBy('updated_at', 'desc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('description', function($d){
                $result = '
                    '.Str::of($d->description)->limit(70).'
                ';
                return $result;
            })
            ->editColumn('image_video', function($d){
                if ($d->image) {
                    $path = asset('uploaded_files/'.'speaking_opportunities/'.$d->created_at->format('Y').'/'.$d->created_at->format('m').'/'.$d->image);
                    $result = '
                        <img data-original="'.$path.'" src="'.$path.'" alt="'.$d->alt.'" width="180" loading="lazy">
                    ';
                } else if ($d->video_link) {
                    $id = substr($d->video_link, strrpos($d->video_link, '/' ) + 1);
                    $link = 'https://www.youtube.com/embed/'.$id;
                    $result = '
                        <iframe width="180" src="'.$link.'" allowfullscreen></iframe>
                    ';
                } else {
                    $result = '-';
                }
                return $result;
            })
            ->editColumn('event_date', function($d){
                if ($d->event_date) {
                    $result = '
                        '.date('F Y', strtotime($d->event_date)).'
                    ';
                } else {
                    $result = '-';
                }
                return $result;
            })
            ->editColumn('highlight', function($d){
                $route = route('admin.highlight_speaking_opportunities', ['id' => $d->id]);
                $toggle = ($d->is_highlight == "false") ? "" : "checked";
                $check = ($d->is_highlight == "false") ? "Off" : "On";
                $result = '
                <form action="'.$route.'" method="POST">
                    '.csrf_field().'
                    <div class="form-check form-switch d-flex flex-column align-items-center justify-content-center ps-0">
                        <input class="form-check-input fs-4 ms-0" type="checkbox" role="switch" name="is_highlight" id="is_highlight" '.$toggle.' onchange="this.form.submit()">
                        <label class="form-label card-title p-0 pt-1 m-0 fs-2" for="is_highlight">
                            '.$check.'
                        </label>
                    </div>
                </form>
                ';
                return $result;
            })
            ->editColumn('action', function($d){
                $result = '
                <div class="d-flex flex-row justify-content-center gap-1">
                    <a type="button" class="btn btn-warning bg-warning" href="/admin/speaking-opportunities/'.$d->id.'/edit">
                        <i class="ti ti-edit fs-4" data-bs-toggle="tooltip" data-bs-title="Edit this Speaking Opportunities"></i>
                    </a>
                    <button type="button" class="btn btn-danger bg-danger" data-bs-toggle="modal" data-bs-target="#delete" onclick="formDelete('.$d->id.')">
                        <i class="ti ti-trash fs-4" data-bs-toggle="tooltip" data-bs-title="Delete this Speaking Opportunities"></i>
                    </button>
                </div>
                ';
                return $result;
            })
            ->rawColumns(['description', 'image_video', 'event_date', 'highlight', 'action'])
            ->make(true);
        }
    }

    public function create(){
        return view('admin.speaking_opportunities.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,bmp,webp|max:2048',
            'video_link' => 'nullable|url',
            'alt' => 'required',
            'description' => 'required',
            'event_date' => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            $speaking_opportunities = new SpeakingOpportunities();
            $speaking_opportunities->title = $request->title;
            $speaking_opportunities->description = $request->description;
            $speaking_opportunities->alt = $request->alt;
            // Video
            if ($request->video_link) {
                if (str_contains($request->video_link, 'https://youtu.be/')) {
                    $speaking_opportunities->video_link = $request->video_link;
                } else {
                    return Redirect::back()->withErrors('Video URL must be from Youtube');
                }
                $speaking_opportunities->image = null;
            }
            // Image
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $file_format = $request->file('image')->getClientOriginalExtension();
                $destinationPath = public_path().'/uploaded_files/'.'speaking_opportunities/'.date('Y').'/'.date('m').'/';
                $time = date('YmdHis');
                $fileName = 'Speaking-Opportunities-'.$time.'.'.$file_format;
                $file->move($destinationPath, $fileName);
                $speaking_opportunities->image = $fileName;
                $speaking_opportunities->video_link = null;
            }
            if ($request->event_date) {
                $speaking_opportunities->event_date = Carbon::createFromFormat('Y-m', $request->event_date)->day(1);
            } else {
                $speaking_opportunities->event_date = null;
            }
            $speaking_opportunities->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.speaking_opportunities')->withSuccess('Speaking Opportunities Was Successfully Created');
    }

    public function edit($id){
        $speaking_opportunities = SpeakingOpportunities::find($id);
        return view('admin.speaking_opportunities.update', [
            'speaking_opportunities' => $speaking_opportunities
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,bmp,webp|max:2048',
            'video_link' => 'nullable|url',
            'alt' => 'required',
            'description' => 'required',
            'event_date' => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            $speaking_opportunities = SpeakingOpportunities::find($id);
            $speaking_opportunities->title = $request->title;
            $speaking_opportunities->description = $request->description;
            $speaking_opportunities->alt = $request->alt;
            // Video
            if ($request->video_link) {
                if (str_contains($request->video_link, 'https://youtu.be/')) {
                    // Delete Old Image
                    if ($old_image_path = $speaking_opportunities->image) {
                        $file_path = public_path('uploaded_files/'.'speaking_opportunities/'.$speaking_opportunities->created_at->format('Y').'/'.$speaking_opportunities->created_at->format('m').'/'.$old_image_path);
                        if (File::exists($file_path)) {
                            File::delete($file_path);
                        }
                    }
                    $speaking_opportunities->video_link = $request->video_link;
                } else {
                    return Redirect::back()->withErrors('Video URL must be from Youtube');
                }
                $speaking_opportunities->image = null;
            } else {
                $speaking_opportunities->video_link = null;
            }
            // Image
            if ($request->hasFile('image')) {
                if ($old_image_path = $speaking_opportunities->image) {
                    $file_path = public_path('uploaded_files/'.'speaking_opportunities/'.$speaking_opportunities->created_at->format('Y').'/'.$speaking_opportunities->created_at->format('m').'/'.$old_image_path);
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                }
                $file = $request->file('image');
                $file_format = $request->file('image')->getClientOriginalExtension();
                $destinationPath = public_path().'/uploaded_files/'.'speaking_opportunities/'.date('Y').'/'.date('m').'/';
                $time = date('YmdHis');
                $fileName = 'Speaking-Opportunities-'.$time.'.'.$file_format;
                $file->move($destinationPath, $fileName);
                $speaking_opportunities->image = $fileName;
                $speaking_opportunities->video_link = null;
            }
            if ($request->event_date) {
                $speaking_opportunities->event_date = Carbon::createFromFormat('Y-m', $request->event_date)->day(1);
            } else {
                $speaking_opportunities->event_date = null;
            }
            $speaking_opportunities->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.speaking_opportunities')->withSuccess('Speaking Opportunities Was Successfully Updated');
    }

    public function delete($id){
        DB::beginTransaction();
        try {
            $speaking_opportunities = SpeakingOpportunities::find($id);
            if ($old_image_path = $speaking_opportunities->image) {
                $file_path = public_path('uploaded_files/'.'speaking_opportunities/'.$speaking_opportunities->created_at->format('Y').'/'.$speaking_opportunities->created_at->format('m').'/'.$old_image_path);
                if (File::exists($file_path)) {
                    File::delete($file_path);
                }
            }
            $speaking_opportunities->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.speaking_opportunities')->withSuccess('Speaking Opportunities Was Successfully Deleted');
    }

    public function set_highlight($id){
        $count_highlight = SpeakingOpportunities::where('is_highlight', 'true')->count();
        $message = '';
        DB::beginTransaction();
        try {
            $speaking_opportunities = SpeakingOpportunities::find($id);
            if ($speaking_opportunities->is_highlight == 'false'){
                if ($count_highlight >= 3) {
                    return redirect()->route('admin.speaking_opportunities')->withErrors('Number of Highlights exceeds 3 Items');
                } else {
                    $speaking_opportunities->is_highlight = 'true';
                    $message = 'Speaking Opportunities has been Successfully Highlighted';
                }
            } else {
                $speaking_opportunities->is_highlight = 'false';
                $message = 'Speaking Opportunities has been Successfully Removed from Highlight';
            }
            $speaking_opportunities->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.speaking_opportunities')->withSuccess($message);
    }
}
