<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;

class ProjectsController extends Controller
{
    public function index(){
        return view('admin.projects.index');
    }

    public function getProjects(Request $request){
        if ($request->ajax()) {
            $data = Projects::orderBy('is_highlight', 'desc')->orderBy('updated_at', 'desc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('date', function($d){
                if ($d->start_date) {
                    $start = '
                        '.date('F Y', strtotime($d->start_date)).'
                    ';
                }
                if ($d->end_date) {
                    $end = '
                        '.date('F Y', strtotime($d->end_date)).'
                    ';
                }
                if ($d->start_date && $d->end_date) {
                    $result = $start .' - '.$end;
                } elseif ($d->start_date) {
                    $result = $start;
                } else {
                    $result = '-';
                }
                return $result;
            })
            ->editColumn('image', function($d){
                if ($d->image) {
                    $path = asset('uploaded_files/'.'projects/'.$d->created_at->format('Y').'/'.$d->created_at->format('m').'/'.$d->image);
                    $result = '
                        <img data-original="'.$path.'" src="'.$path.'" alt="'.$d->alt.'" width="150" loading="lazy">
                    ';
                } else {
                    $result = '-';
                }
                return $result;
            })
            ->editColumn('description', function($d){
                $result = '
                    '.Str::of($d->description)->limit(70).'
                ';
                return $result;
            })
            ->editColumn('highlight', function($d){
                $route = route('admin.highlight_projects', ['id' => $d->id]);
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
                    <a type="button" class="btn btn-warning bg-warning" href="/admin/projects/'.$d->id.'/edit">
                        <i class="ti ti-edit fs-4" data-bs-toggle="tooltip" data-bs-title="Edit this Projects"></i>
                    </a>
                    <button type="button" class="btn btn-danger bg-danger" data-bs-toggle="modal" data-bs-target="#delete" onclick="formDelete('.$d->id.')">
                        <i class="ti ti-trash fs-4" data-bs-toggle="tooltip" data-bs-title="Delete this Projects"></i>
                    </button>
                </div>
                ';
                return $result;
            })
            ->rawColumns(['date', 'image', 'description', 'highlight', 'action'])
            ->make(true);
        }
    }

    public function create(){
        return view('admin.projects.create');
    }

    public function store(Request $request){
        $request->validate([
            'organization_name' => 'required',
            'roles' => 'required',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'image' => 'nullable|mimes:jpeg,jpg,png,bmp,webp|max:2048',
            'alt' => 'nullable',
            'description' => 'required',
            'button_title' => 'nullable',
            'button_link' => 'nullable|url',
        ]);

        DB::beginTransaction();
        try {
            $projects = new Projects();
            $projects->organization_name = $request->organization_name;
            $projects->roles = $request->roles;
            if ($request->start_date) {
                $projects->start_date = Carbon::createFromFormat('Y-m', $request->start_date)->day(1);
            }
            if ($request->end_date) {
                $projects->end_date = Carbon::createFromFormat('Y-m', $request->end_date)->day(1);
            }
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $file_format = $request->file('image')->getClientOriginalExtension();
                $destinationPath = public_path().'/uploaded_files/'.'projects/'.date('Y').'/'.date('m').'/';
                $time = date('YmdHis');
                $fileName = 'Projects-'.$time.'.'.$file_format;
                $file->move($destinationPath, $fileName);
                $projects->image = $fileName;
            }
            $projects->alt = $request->alt;
            $projects->description = $request->description;
            $projects->button_title = $request->button_title;
            $projects->button_link = $request->button_link;
            $projects->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.projects')->withSuccess('Projects Was Successfully Created');
    }

    public function edit($id){
        $projects = Projects::find($id);
        return view('admin.projects.update', [
            'projects' => $projects
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'organization_name' => 'required',
            'roles' => 'required',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'image' => 'nullable|mimes:jpeg,jpg,png,bmp,webp|max:2048',
            'alt' => 'nullable',
            'description' => 'required',
            'button_title' => 'nullable',
            'button_link' => 'nullable|url',
        ]);

        DB::beginTransaction();
        try {
            $projects = Projects::find($id);
            $projects->organization_name = $request->organization_name;
            $projects->roles = $request->roles;
            if ($request->start_date) {
                $projects->start_date = Carbon::createFromFormat('Y-m', $request->start_date)->day(1);
            } else {
                $projects->start_date = null;
            }
            if ($request->end_date) {
                $projects->end_date = Carbon::createFromFormat('Y-m', $request->end_date)->day(1);
            } else {
                $projects->end_date = null;
            }
            if ($request->hasFile('image')) {
                if ($old_image_path = $projects->image) {
                    $file_path = public_path('uploaded_files/'.'projects/'.$projects->created_at->format('Y').'/'.$projects->created_at->format('m').'/'.$old_image_path);
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                }
                $file = $request->file('image');
                $file_format = $request->file('image')->getClientOriginalExtension();
                $destinationPath = public_path().'/uploaded_files/'.'projects/'.date('Y').'/'.date('m').'/';
                $time = date('YmdHis');
                $fileName = 'Projects-'.$time.'.'.$file_format;
                $file->move($destinationPath, $fileName);
                $projects->image = $fileName;
            } else {
                if (isset($_POST['delete_img'])) {
                    if ($old_image_path = $projects->image) {
                        $file_path = public_path('uploaded_files/'.'projects/'.$projects->created_at->format('Y').'/'.$projects->created_at->format('m').'/'.$old_image_path);
                        if (File::exists($file_path)) {
                            File::delete($file_path);
                        }
                        $projects->image = null;
                    }
                }
            }
            $projects->alt = $request->alt;
            $projects->description = $request->description;
            $projects->button_title = $request->button_title;
            $projects->button_link = $request->button_link;
            $projects->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.projects')->withSuccess('Projects Was Successfully Updated');
    }

    public function delete($id){
        DB::beginTransaction();
        try {
            $projects = Projects::find($id);
            if ($old_image_path = $projects->image) {
                $file_path = public_path('uploaded_files/'.'projects/'.$projects->created_at->format('Y').'/'.$projects->created_at->format('m').'/'.$old_image_path);
                if (File::exists($file_path)) {
                    File::delete($file_path);
                }
            }
            $projects->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.projects')->withSuccess('Projects Was Successfully Deleted');
    }

    public function set_highlight($id){
        $message = '';
        DB::beginTransaction();
        try {
            $projects = Projects::find($id);
            if ($projects->is_highlight == 'inactive'){
                $projects->is_highlight = 'active';
                $message = 'Projects has been Successfully Highlighted';
            } else {
                $projects->is_highlight = 'inactive';
                $message = 'Projects has been Successfully Removed from Highlight';
            }
            $projects->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.projects')->withSuccess($message);
    }
}
