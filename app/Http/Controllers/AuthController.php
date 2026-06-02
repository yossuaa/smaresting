<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function registerForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()->with('error', 'Username atau password salah.');
        }

        if (!password_get_info($user->password)['algo']) {
            $user->password = Hash::make($user->password);
            $user->save();
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Username atau password salah.');
        }

        Session::put('user_id', $user->id);
        Session::put('user_name', $user->username);
        Session::put('user_email', $user->email);

        return redirect('/dashboard');
    }

    public function changePasswordForm()
    {
        if (!Session::has('user_id')) {
            return redirect('/login');
        }

        return view('change-password');
    }

    public function changePassword(Request $request)
    {
        if (!Session::has('user_id')) {
            return redirect('/login');
        }

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = User::find(Session::get('user_id'));

        if (!$user) {
            Session::flush();
            return redirect('/login');
        }

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Password lama salah.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
