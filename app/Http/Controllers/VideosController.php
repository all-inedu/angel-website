<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videos;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class VideosController extends Controller
{
    public function index(){
        return view('admin.videos.index');
    }

    public function getVideos(Request $request){
        if ($request->ajax()) {
            $data = Videos::orderBy('is_highlight', 'desc')->orderBy('updated_at', 'desc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('video', function($d){
                $id = substr($d->video_link, strrpos($d->video_link, '/' ) + 1);
                $link = 'https://www.youtube.com/embed/'.$id;
                $result = '
                    <iframe width="320" height="180" src="'.$link.'" title="'.$d->title.'" frameborder="0" allowfullscreen></iframe>
                ';
                return $result;
            })
            ->editColumn('highlight', function($d){
                $route = route('admin.highlight_videos', ['id' => $d->id]);
                $toggle = ($d->is_highlight == "inactive") ? "" : "checked";
                $check = ($d->is_highlight == "inactive") ? "Inactive" : "Active";
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
                <div class="d-flex flex-column align-items-center justify-content-center gap-1">
                    <a type="button" class="btn btn-warning bg-warning" href="/admin/videos/'.$d->id.'/edit">
                        <i class="ti ti-edit fs-4" data-bs-toggle="tooltip" data-bs-title="Edit this Videos"></i>
                    </a>
                    <button type="button" class="btn btn-danger bg-danger" data-bs-toggle="modal" data-bs-target="#delete" onclick="formDelete('.$d->id.')">
                        <i class="ti ti-trash fs-4" data-bs-toggle="tooltip" data-bs-title="Delete this Videos"></i>
                    </button>
                </div>
                ';
                return $result;
            })
            ->rawColumns(['video', 'highlight', 'action'])
            ->make(true);
        }
    }

    public function create(){
        return view('admin.videos.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'video_link' => 'required|url',
        ]);

        DB::beginTransaction();
        try {
            $videos = new Videos();
            $videos->title = $request->title;
            // Video
            if ($request->video_link) {
                if (str_contains($request->video_link, 'https://youtu.be/')) {
                    $videos->video_link = $request->video_link;
                } else {
                    return Redirect::back()->withInput()->withErrors('Video URL must be from Youtube');
                }
            }
            $videos->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.videos')->withSuccess('Video Was Successfully Created');
    }

    public function edit($id){
        $videos = Videos::find($id);
        return view('admin.videos.update', [
            'videos' => $videos
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required',
            'video_link' => 'required|url',
        ]);

        DB::beginTransaction();
        try {
            $videos = Videos::find($id);
            $videos->title = $request->title;
            // Video
            if ($request->video_link) {
                if (str_contains($request->video_link, 'https://youtu.be/')) {
                    $videos->video_link = $request->video_link;
                } else {
                    return Redirect::back()->withInput()->withErrors('Video URL must be from Youtube');
                }
            }
            $videos->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.videos')->withSuccess('Video Was Successfully Updated');
    }

    public function delete($id){
        DB::beginTransaction();
        try {
            $videos = Videos::find($id);
            $videos->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.videos')->withSuccess('Video Was Successfully Deleted');
    }

    public function set_highlight($id){
        $count_highlight = Videos::where('is_highlight', 'active')->count();
        $message = '';
        DB::beginTransaction();
        try {
            $videos = Videos::find($id);
            if ($videos->is_highlight == 'inactive'){
                if ($count_highlight >= 1) {
                    return redirect()->route('admin.videos')->withErrors('Number of Highlights exceeds 1 Item');
                } else {
                    $videos->is_highlight = 'active';
                    $message = 'Video has been Successfully Highlighted';
                }
            } else {
                $videos->is_highlight = 'inactive';
                $message = 'Video has been Successfully Removed from Highlight';
            }
            $videos->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.videos')->withSuccess($message);
    }
}
