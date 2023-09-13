<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AwardAchievement;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class AwardAchievementController extends Controller
{
    public function index(){
        return view('admin.award_achievement.index');
    }

    public function getAwardAchievement(Request $request){
        if ($request->ajax()) {
            $data = AwardAchievement::orderBy('updated_at', 'desc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('image', function($d){
                $path = asset('uploaded_files/'.'award_achievement/'.$d->created_at->format('Y').'/'.$d->created_at->format('m').'/'.$d->image);
                $result = '
                    <img data-original="'.$path.'" src="'.$path.'" alt="'.$d->alt.'" width="150" loading="lazy">
                ';
                return $result;
            })
            ->editColumn('competition_date', function($d){
                if ($d->competition_date) {
                    $result = '
                        '.date('F Y', strtotime($d->competition_date)).'
                    ';
                } else {
                    $result = '-';
                }
                return $result;
            })
            ->editColumn('action', function($d){
                $result = '
                <div class="d-flex flex-row justify-content-center gap-1">
                    <a type="button" class="btn btn-warning bg-warning" href="/admin/award-achievement/'.$d->id.'/edit">
                        <i class="ti ti-edit fs-4" data-bs-toggle="tooltip" data-bs-title="Edit this Award & Achievement"></i>
                    </a>
                    <button type="button" class="btn btn-danger bg-danger" data-bs-toggle="modal" data-bs-target="#delete" onclick="formDelete('.$d->id.')">
                        <i class="ti ti-trash fs-4" data-bs-toggle="tooltip" data-bs-title="Delete this Award & Achievement"></i>
                    </button>
                </div>
                ';
                return $result;
            })
            ->rawColumns(['image', 'competition_date', 'action'])
            ->make(true);
        }
    }

    public function create(){
        return view('admin.award_achievement.create');
    }

    public function store(Request $request){
        $request->validate([
            'competition_name' => 'required',
            'award_name' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,bmp,webp|max:2048',
            'alt' => 'required',
            'competition_date' => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            $award_achievement = new AwardAchievement();
            $award_achievement->competition_name = $request->competition_name;
            $award_achievement->award_name = $request->award_name;
            $award_achievement->alt = $request->alt;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $file_format = $request->file('image')->getClientOriginalExtension();
                $destinationPath = public_path().'/uploaded_files/'.'award_achievement/'.date('Y').'/'.date('m').'/';
                $time = date('YmdHis');
                $fileName = 'Award-Achievement-'.$time.'.'.$file_format;
                $file->move($destinationPath, $fileName);
                $award_achievement->image = $fileName;
            }
            if ($request->competition_date) {
                $award_achievement->competition_date = Carbon::createFromFormat('Y-m', $request->competition_date)->day(1);
            } else {
                $award_achievement->competition_date = null;
            }
            $award_achievement->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.award_achievement')->withSuccess('Award & Achievement Was Successfully Created');
    }

    public function edit($id){
        $award_achievement = AwardAchievement::find($id);
        return view('admin.award_achievement.update', [
            'award_achievement' => $award_achievement
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'competition_name' => 'required',
            'award_name' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,bmp,webp|max:2048',
            'alt' => 'required',
            'competition_date' => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            $award_achievement = AwardAchievement::find($id);
            $award_achievement->competition_name = $request->competition_name;
            $award_achievement->award_name = $request->award_name;
            $award_achievement->alt = $request->alt;
            if ($request->hasFile('image')) {
                if ($old_image_path = $award_achievement->image) {
                    $file_path = public_path('uploaded_files/'.'award_achievement/'.$award_achievement->created_at->format('Y').'/'.$award_achievement->created_at->format('m').'/'.$old_image_path);
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                }
                $file = $request->file('image');
                $file_format = $request->file('image')->getClientOriginalExtension();
                $destinationPath = public_path().'/uploaded_files/'.'award_achievement/'.date('Y').'/'.date('m').'/';
                $time = date('YmdHis');
                $fileName = 'Award-Achievement-'.$time.'.'.$file_format;
                $file->move($destinationPath, $fileName);
                $award_achievement->image = $fileName;
            }
            if ($request->competition_date) {
                $award_achievement->competition_date = Carbon::createFromFormat('Y-m', $request->competition_date)->day(1);
            } else {
                $award_achievement->competition_date = null;
            }
            $award_achievement->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.award_achievement')->withSuccess('Award & Achievement Was Successfully Updated');
    }

    public function delete($id){
        DB::beginTransaction();
        try {
            $award_achievement = AwardAchievement::find($id);
            if ($old_image_path = $award_achievement->image) {
                $file_path = public_path('uploaded_files/'.'award_achievement/'.$award_achievement->created_at->format('Y').'/'.$award_achievement->created_at->format('m').'/'.$old_image_path);
                if (File::exists($file_path)) {
                    File::delete($file_path);
                }
            }
            $award_achievement->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.award_achievement')->withSuccess('Award & Achievement Was Successfully Deleted');
    }
}
