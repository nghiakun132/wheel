<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.index');
        }

        return redirect()->route('admin.login')->with('error', 'Email hoặc mật khẩu không đúng');
    }

    public function logout()
    {
        auth()->guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}
