<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Halaman tujuan setelah masuk, sesuai role.
     */
    private function ruteSetelahMasuk(User $user): string
    {
        return in_array($user->role, ['admin', 'kontributor'], true)
            ? route('admin.home')
            : route('akun');
    }

    /**
     * GET /login — tampilkan form login.
     * Kalau sudah login, langsung ke halaman yang sesuai role.
     */
    public function showLogin()
    {
        if ($user = Auth::user()) {
            return redirect($this->ruteSetelahMasuk($user));
        }

        return view('auth.login');
    }

    /**
     * POST /login — proses login.
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

        $user = $request->user();

        // Pengunjung biasa tidak diarahkan ke panel admin.
        if ($user->role === 'user') {
            return redirect()->route('akun');
        }

        return redirect()->intended(route('admin.home'));
    }

    /**
     * GET /register — tampilkan form pendaftaran pengunjung.
     */
    public function showRegister()
    {
        if ($user = Auth::user()) {
            return redirect($this->ruteSetelahMasuk($user));
        }

        return view('auth.register');
    }

    /**
     * POST /register — daftarkan akun pengunjung baru.
     *
     * Role selalu "user"; kontributor/admin hanya dibuat lewat admin panel.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['accepted'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'user',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route('akun')
            ->with('status', 'Akun berhasil dibuat. Selamat datang di Jejak Bali!');
    }

    /**
     * POST /logout — keluar dari akun.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
