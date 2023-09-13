<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ChangePasswordController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'old_password' => 'required|min:6|max:45',
            'new_password' => 'required|min:6|max:45|different:old_password',
        ],[
            'old_password.required' => 'Old Password is required',
            'new_password.required' => 'New Password is required',
            'new_password.different' => 'New Password cannot be the same as Old Password',
        ]);
    
        DB::beginTransaction();
        try {
            $user_admin = Admin::where('email', Auth::user()->email)->first();
            if (Hash::check($request->old_password, $user_admin->password)) {
                $user_admin->password = $request->new_password;
            } else {
                Redirect::back()->withErrors('Your Old Password Incorrect');
            }
            $user_admin->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return Redirect::back()->withSuccess('Your Password Was Successfully Updated');
    }
}