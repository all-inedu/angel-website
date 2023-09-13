<?php

namespace App\Http\Controllers;

use App\Models\ContactWithMe;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ContactWithMeController extends Controller
{
    public function index(){
        return view('admin.contact_with_me.index');
    }

    public function getContactWithMe(Request $request){
        if ($request->ajax()) {
            $data = ContactWithMe::orderBy('updated_at', 'desc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('message', function($d){
                $result = '
                    '.Str::of($d->message)->limit(70).'
                ';
                return $result;
            })
            ->editColumn('action', function($d){
                $name = "'".$d->name."'";
                $contact_number = "'".$d->contact_number."'";
                $email = "'".$d->email."'";
                $message = "'".$d->message."'";
                $result = '
                <div class="d-flex flex-row justify-content-center gap-1">
                    <button type="button" class="btn btn-warning bg-warning" data-bs-toggle="modal" data-bs-target="#viewDetail" onclick="viewItem('.$d->id.', '.$name.', '.$contact_number.', '.$email.', '.$message.')">
                        <i class="ti ti-search fs-4" data-bs-toggle="tooltip" data-bs-title="View this Contact With Me"></i>
                    </button>
                </div>
                ';
                return $result;
            })
            ->rawColumns(['message', 'action'])
            ->make(true);
        }
    }
}
