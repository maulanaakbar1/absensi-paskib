<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        // Mengarah ke folder views/auth/login.blade.php
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            // Redirect sesuai role
            if ($user->role === 'admin') return redirect()->intended('/admin/dashboard');
            if ($user->role === 'pembina') return redirect()->intended('/pembina/dashboard');
            
            return redirect()->intended('/siswa/dashboard');
        }

        return back()->with('loginError', 'Email atau password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}