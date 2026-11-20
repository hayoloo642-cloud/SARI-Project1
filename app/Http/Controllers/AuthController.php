<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * GET /login — tampilkan form login.
     * Kalau sudah login, langsung ke panel admin.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.home');
        }

        return view('auth.login');
    }

    /**
     * POST /login — proses login (role dicek di route /admin oleh middleware).
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Email atau password salah.']);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.home'));
    }

    /**
     * POST /logout — keluar dari panel admin.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
