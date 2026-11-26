@php
    $judulHalaman = trim($__env->yieldContent('title')) ?: 'Jejak Bali — Wisata Lokal dan Budaya Pulau Dewata';
    $deskripsiHalaman = trim($__env->yieldContent('description')) ?: 'Temukan wisata lokal Bali di luar zona padat. Panduan etika budaya, destinasi asli, dan kontak langsung warga.';
    $metaGambar = trim($__env->yieldContent('og_image')) ?: asset('assets/images/hero.jpg');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judulHalaman }}</title>
    <meta name="description" content="{{ $deskripsiHalaman }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Sora:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v=1">
    <link rel="stylesheet" href="{{ asset('assets/css/app-sari.css') }}?v=1">
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/favicon.svg') }}">
    <meta name="theme-color" content="#0b2239">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $judulHalaman }}">
    <meta property="og:description" content="{{ $deskripsiHalaman }}">
    <meta property="og:image" content="{{ $metaGambar }}">
    <meta name="twitter:card" content="summary_large_image">
    @stack('head')
</head>
<body data-auth="{{ auth()->check() ? '1' : '0' }}" data-user-id="{{ auth()->id() }}" data-login-url="{{ route('login') }}">

<noscript>
    <div style="background:#faf0e8;border-bottom:1px solid #e7d3c2;padding:0.8rem 1.2rem;font-size:0.9rem;color:#7a3b1e;text-align:center;">
        Aktifkan JavaScript agar pencarian, galeri, dan formulir berjalan optimal.
    </div>
</noscript>

<nav class="nav">
    <div class="nav-inner">
        <a href="{{ route('home') }}" class="brand" aria-label="Jejak Bali — Beranda">Jejak Bali<b>.</b></a>

        <ul class="nav-links" id="nav-menu">
            <li><a href="{{ route('destinasi.index') }}" class="{{ request()->routeIs('destinasi.*') ? 'aktif' : '' }}">Destinasi Lokal</a></li>
            <li><a href="{{ route('etika.index') }}" class="{{ request()->routeIs('etika.*') ? 'aktif' : '' }}">Etika Budaya</a></li>
            <li><a href="{{ route('kalender.index') }}" class="{{ request()->routeIs('kalender.*') ? 'aktif' : '' }}">Kalender Agama</a></li>
            <li><a href="{{ route('tentang') }}" class="{{ request()->routeIs('tentang') ? 'aktif' : '' }}">Tentang Jejak Bali</a></li>

            <li class="nav-mobile-divider" aria-hidden="true"></li>
            <li class="nav-mobile-action">
                @auth
                    <a href="{{ in_array(auth()->user()->role, ['admin', 'kontributor'], true) ? route('admin.home') : route('akun') }}"><x-icon name="user" /> <span>{{ Str::of(auth()->user()->name)->explode(' ')->first() }}</span></a>
                @else
                    <a href="{{ route('login') }}"><x-icon name="user" /> <span>Masuk / Daftar</span></a>
                @endauth
            </li>
            <li class="nav-mobile-action">
                <a href="https://wa.me/6281234567890" class="nav-mobile-wa" target="_blank" rel="noopener"><x-icon name="wa" /> <span>Hubungi Kami</span></a>
            </li>
        </ul>

        <div class="nav-right">
            <a href="https://wa.me/6281234567890" class="btn-nav-wa" target="_blank" rel="noopener">Hubungi Kami</a>

            @auth
                <a href="{{ in_array(auth()->user()->role, ['admin', 'kontributor'], true) ? route('admin.home') : route('akun') }}" class="btn btn-outline btn-nav-user">
                    <x-icon name="user" /> <span>{{ Str::of(auth()->user()->name)->explode(' ')->first() }}</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline btn-nav-user">
                    <x-icon name="user" /> <span>Masuk</span>
                </a>
            @endauth

            <button class="nav-toggle" id="btn-menu" aria-label="Buka menu" aria-expanded="false">
                <x-icon name="menu" />
            </button>
        </div>
    </div>
</nav>

@if (session('status'))
    <div class="sari-flash">{{ session('status') }}</div>
@endif

@yield('content')

<hr class="orn-divider" aria-hidden="true">

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <span class="footer-brand">Jejak Bali<b>.</b> <span class="aksara" style="color:rgba(255,255,255,.5); font-size:0.9em;">ᬩᬮᬶ</span></span>
                <p>Eksplorasi destinasi lokal, adat, dan budaya Pulau Dewata untuk wisatawan bijak. Semua destinasi dikurasi langsung bersama warga desa adat di 9 wilayah Bali — tanpa komisi, tanpa iklan, tanpa perantara.</p>
            </div>
            <div>
                <h4>Jelajah</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('destinasi.index') }}">Destinasi Lokal</a></li>
                    <li><a href="{{ route('etika.index') }}">Etika Budaya</a></li>
                    <li><a href="{{ route('kalender.index') }}">Kalender Agama</a></li>
                    <li><a href="{{ route('tentang') }}">Tentang Jejak Bali</a></li>
                </ul>
            </div>
            <div>
                <h4>Untuk Desa &amp; Pengelola</h4>
                <ul>
                    <li><a href="https://wa.me/6281234567890?text=Halo%20Jejak%20Bali%2C%20desa%20kami%20ingin%20mendaftarkan%20destinasi." target="_blank" rel="noopener">Daftarkan destinasi Anda</a></li>
                    <li><a href="{{ route('login') }}">Panel Kontributor</a></li>
                    <li><a href="{{ route('tentang') }}">Cara kurasi destinasi</a></li>
                    <li><a href="{{ route('privasi') }}">Kebijakan Privasi</a></li>
                </ul>
            </div>
            <div>
                <h4>Kontak &amp; Layanan</h4>
                <ul>
                    <li>WhatsApp: <a href="https://wa.me/6281234567890" target="_blank" rel="noopener">0812-3456-7890</a></li>
                    <li>Email: <a href="mailto:info@jejakbali.id">info@jejakbali.id</a></li>
                    <li>Layanan: 08.00–21.00 WITA</li>
                    <li><a href="https://wa.me/6281234567890?text=Halo%20Jejak%20Bali%2C%20saya%20mau%20update%20kalender%20ritual." target="_blank" rel="noopener">Update kalender ritual via WA</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom" style="display:flex; justify-content:space-between; align-items:center; gap:0.8rem; flex-wrap:wrap;">
            <span>&copy; {{ date('Y') }} Jejak Bali — Wisata Lokal Bali.</span>
            <span>Dibuat bersama warga desa adat, untuk wisatawan yang menghormati.</span>
        </div>
    </div>
</footer>

<script src="{{ asset('assets/js/sari.js') }}?v=1"></script>
@stack('scripts')
</body>
</html>
