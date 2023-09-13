<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChangeMakingProject;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ChangeMakingProjectController extends Controller
{
    public function index(){
        return view('admin.change_making_project.index');
    }

    public function getChangeMakingProject(Request $request){
        if ($request->ajax()) {
            $data = ChangeMakingProject::orderBy('is_highlight', 'desc')->orderBy('updated_at', 'desc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('description', function($d){
                $result = '
                    '.Str::of($d->description)->limit(70).'
                ';
                return $result;
            })
            ->editColumn('end_date', function($d){
                if ($d->end_date) {
                    $result = '
                        '.date('F Y', strtotime($d->end_date)).'
                    ';
                } else {
                    $result = '-';
                }
                return $result;
            })
            ->editColumn('highlight', function($d){
                $route = route('admin.highlight_change_making_project', ['id' => $d->id]);
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
                    <a type="button" class="btn btn-warning bg-warning" href="/admin/change-making-project/'.$d->id.'/edit">
                        <i class="ti ti-edit fs-4" data-bs-toggle="tooltip" data-bs-title="Edit this Change Making Project"></i>
                    </a>
                    <button type="button" class="btn btn-danger bg-danger" data-bs-toggle="modal" data-bs-target="#delete" onclick="formDelete('.$d->id.')">
                        <i class="ti ti-trash fs-4" data-bs-toggle="tooltip" data-bs-title="Delete this Change Making Project"></i>
                    </button>
                </div>
                ';
                return $result;
            })
            ->rawColumns(['description', 'end_date', 'highlight', 'action'])
            ->make(true);
        }
    }

    public function create(){
        return view('admin.change_making_project.create');
    }

    public function store(Request $request){
        $request->validate([
            'organization_name' => 'required',
            'roles' => 'required',
            'description' => 'required',
            'button_title' => 'nullable',
            'button_link' => 'nullable|url',
            'end_date' => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            $change_making_project = new ChangeMakingProject();
            $change_making_project->organization_name = $request->organization_name;
            $change_making_project->roles = $request->roles;
            $change_making_project->description = $request->description;
            $change_making_project->button_title = $request->button_title;
            $change_making_project->button_link = $request->button_link;
            if ($request->end_date) {
                $change_making_project->end_date = Carbon::createFromFormat('Y-m', $request->end_date)->day(1);
            } else {
                $change_making_project->end_date = null;
            }
            $change_making_project->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.change_making_project')->withSuccess('Change Making Project Was Successfully Created');
    }

    public function edit($id){
        $change_making_project = ChangeMakingProject::find($id);
        return view('admin.change_making_project.update', [
            'change_making_project' => $change_making_project
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'organization_name' => 'required',
            'roles' => 'required',
            'description' => 'required',
            'button_title' => 'nullable',
            'button_link' => 'nullable|url',
            'end_date' => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            $change_making_project = ChangeMakingProject::find($id);
            $change_making_project->organization_name = $request->organization_name;
            $change_making_project->roles = $request->roles;
            $change_making_project->description = $request->description;
            $change_making_project->button_title = $request->button_title;
            $change_making_project->button_link = $request->button_link;
            if ($request->end_date) {
                $change_making_project->end_date = Carbon::createFromFormat('Y-m', $request->end_date)->day(1);
            } else {
                $change_making_project->end_date = null;
            }
            $change_making_project->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.change_making_project')->withSuccess('Change Making Project Was Successfully Updated');
    }

    public function delete($id){
        DB::beginTransaction();
        try {
            $change_making_project = ChangeMakingProject::find($id);
            $change_making_project->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.change_making_project')->withSuccess('Change Making Project Was Successfully Deleted');
    }

    public function set_highlight($id){
        $count_highlight = ChangeMakingProject::where('is_highlight', 'true')->count();
        $message = '';
        DB::beginTransaction();
        try {
            $change_making_project = ChangeMakingProject::find($id);
            if ($change_making_project->is_highlight == 'false'){
                if ($count_highlight >= 3) {
                    return redirect()->route('admin.change_making_project')->withErrors('Number of Highlights exceeds 3 Items');
                } else {
                    $change_making_project->is_highlight = 'true';
                    $message = 'Change Making Project has been Successfully Highlighted';
                }
            } else {
                $change_making_project->is_highlight = 'false';
                $message = 'Change Making Project has been Successfully Removed from Highlight';
            }
            $change_making_project->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.change_making_project')->withSuccess($message);
    }
}
