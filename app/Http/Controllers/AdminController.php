<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginHandler (Request $request){
        $request->validate([
            'email' => 'required|email|exists:tb_admins,email',
            'password' => 'required|min:6|max:45',
        ],[
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email address',
            'email.exists' => 'Email is not exists in system',
            'password.required' => 'Password is required',
        ]);

        $credentials = array(
            'email' => $request->email,
            'password' => $request->password
        );

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard')->withSuccess('Signed in successfully');
        } else {
            session()->flash('fail', 'Incorrect Credentials');
            return redirect()->route('admin.login');
        }
    }

    public function logoutHandler (Request $request){
        Auth::guard('admin')->logout();
        session()->flash('fail', 'You are logged out!');
        return redirect()->route('admin.login');
    }
}
