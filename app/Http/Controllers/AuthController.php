<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $req)
    {
        if ($req->username == 'admin' && $req->password == 'admin') {
            Session::put('login', true);
            return redirect('/dashboard');
        }

        return back()->with('error', 'Login gagal');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}
