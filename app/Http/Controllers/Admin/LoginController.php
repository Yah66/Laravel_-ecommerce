<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\LoginReuest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function getlogin(){
        return view('auth.login');
    }

    public function login(LoginReuest $request)
    {
        // $remember_me = $request->has('remember_me') ? true : false;
        // dd(auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")]));
        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")])) {
            // notify()->success('تم الدخول بنجاح  ');
            // dd('sadasd');
            return redirect()->route('admin.index');
        }
        // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
        return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);
    }
}