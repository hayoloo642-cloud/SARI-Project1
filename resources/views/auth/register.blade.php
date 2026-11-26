@extends('layouts.sari')

@section('title', 'Daftar Akun — Jejak Bali')
@section('description', 'Buat akun gratis Jejak Bali untuk menyimpan destinasi favorit dan berbagi ulasan perjalanan Anda di Bali.')

@section('content')
    <main class="auth-wrap">
        <div class="auth-card">
            <span class="brand">Jejak Bali<b>.</b></span>
            <h1>Buat Akun Pengunjung</h1>
            <p class="auth-sub">Gratis. Tanpa iklan. Simpan destinasi favorit dan bagikan pengalaman Anda.</p>

            @if ($errors->any())
                <div class="auth-error" role="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('register.store') }}">
                @csrf

                <label class="auth-field">
                    <span>Nama lengkap</span>
                    <input class="form-control"
                           type="text"
                           name="name"
                           value="{{ old('name') }}"
                           autocomplete="name"
                           placeholder="Nama Anda"
                           required
                           autofocus>
                </label>

                <label class="auth-field">
                    <span>Email</span>
                    <input class="form-control"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           autocomplete="email"
                           placeholder="nama@contoh.id"
                           required>
                </label>

                <label class="auth-field">
                    <span>Password</span>
                    <input class="form-control"
                           type="password"
                           name="password"
                           autocomplete="new-password"
                           placeholder="Minimal 8 karakter"
                           minlength="8"
                           required>
                </label>

                <label class="auth-field">
                    <span>Ulangi password</span>
                    <input class="form-control"
                           type="password"
                           name="password_confirmation"
                           autocomplete="new-password"
                           placeholder="Ulangi password Anda"
                           minlength="8"
                           required>
                </label>

                <label class="auth-remember" style="align-items: flex-start;">
                    <input type="checkbox" name="terms" value="1" required @checked(old('terms'))>
                    <span style="line-height:1.6;">
                        Saya setuju dengan
                        <a href="{{ route('privasi') }}" style="color: var(--blue); font-weight: 700;">kebijakan privasi</a>
                        dan akan menghormati adat setempat.
                    </span>
                </label>

                <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
            </form>

            <p class="auth-alt">
                Sudah punya akun?
                <a href="{{ route('login') }}">Masuk di sini</a>
            </p>
            <p class="auth-alt" style="margin-top:0.6rem;">
                Ingin mendaftarkan destinasi desa Anda?
                <a href="https://wa.me/6281234567890?text=Halo%20Jejak%20Bali%2C%20saya%20ingin%20mendaftar%20sebagai%20kontributor." target="_blank" rel="noopener">Hubungi kami</a>
            </p>
            <p class="auth-alt" style="margin-top:0.6rem;">
                <a href="{{ route('home') }}">&larr; Kembali ke beranda</a>
            </p>
        </div>
    </main>
@endsection
