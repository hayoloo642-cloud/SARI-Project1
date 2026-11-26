@extends('layouts.sari')

@section('title', 'Masuk — Jejak Bali Panel Kontributor')
@section('description', 'Masuk ke panel Jejak Bali untuk mengelola destinasi lokal Bali, moderasi ulasan, dan statistik kunjungan.')
@section('content')
    <main class="auth-wrap">
        <div class="auth-card">
            <span class="brand">Jejak Bali<b>.</b></span>
            <h1>Masuk Panel Kontributor</h1>
            <p class="auth-sub">Kelola destinasi, ulasan, dan statistik kunjungan desa Anda.</p>

            @if ($errors->any())
                <div class="auth-error" role="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login.attempt') }}">
                @csrf

                <label class="auth-field">
                    <span>Email</span>
                    <input class="form-control"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           autocomplete="email"
                           placeholder="nama@contoh.id"
                           required
                           autofocus>
                </label>

                <label class="auth-field">
                    <span>Password</span>
                    <input class="form-control"
                           type="password"
                           name="password"
                           autocomplete="current-password"
                           placeholder="••••••••"
                           required>
                </label>

                <label class="auth-remember">
                    <input type="checkbox" name="remember" value="1">
                    Ingat saya di perangkat ini
                </label>

                <button type="submit" class="btn btn-primary">Masuk</button>
            </form>

            <p class="auth-alt">
                Belum punya akun?
                <a href="{{ route('register') }}">Daftar sebagai pengunjung</a>
            </p>
            <p class="auth-alt" style="margin-top:0.6rem;">
                Ingin menjadi kontributor desa?
                <a href="https://wa.me/6281234567890?text=Halo%20Jejak%20Bali%2C%20saya%20ingin%20mendaftar%20sebagai%20kontributor." target="_blank" rel="noopener">Hubungi kami</a>
            </p>
            <p class="auth-alt" style="margin-top:0.6rem;">
                <a href="{{ route('home') }}">&larr; Kembali ke beranda</a>
            </p>
        </div>
    </main>
@endsection
