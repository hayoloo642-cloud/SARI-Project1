@extends('layouts.sari')

@section('title', ($title ?? 'Panel Admin') . ' — Jejak Bali')

@section('content')
<section class="section" style="padding-top: 7rem; min-height: 85vh;">
    <div class="container">
        <!-- Header Bar -->
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem; margin-bottom: 2rem; border-bottom: 1.5px solid var(--line); padding-bottom: 1.5rem;">
            <div>
                <span class="kicker" style="color:var(--terra); font-weight:700; text-transform:uppercase; font-size:0.75rem; letter-spacing:0.05em;">Panel Pengelolaan</span>
                <h1 style="margin: 0.3rem 0 0; font-size: 1.85rem; color: var(--navy);">{{ $headerTitle ?? 'Dashboard' }}</h1>
                <p style="margin: 0.2rem 0 0; color: var(--muted); font-size: 0.9rem;">
                    Masuk sebagai <strong>{{ auth()->user()->name }}</strong> ({{ ucfirst(auth()->user()->role) }})
                </p>
            </div>
            <div style="display:flex; gap:0.6rem; align-items:center;">
                <a href="{{ route('home') }}" class="btn btn-outline" style="padding:0.5rem 1rem; font-size:0.85rem;" target="_blank">
                    <x-icon name="globe" /> <span>Lihat Web</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline" style="padding:0.5rem 1rem; font-size:0.85rem; color:#dc2626; border-color:#fca5a5;">
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Admin Navigation Tabs -->
        <div style="display:flex; gap:0.5rem; overflow-x:auto; padding-bottom:0.75rem; margin-bottom:2rem; border-bottom:1px solid var(--line);">
            <a href="{{ route('admin.home') }}" class="btn {{ request()->routeIs('admin.home') ? 'btn-primary' : 'btn-outline' }}" style="padding:0.55rem 1.15rem; font-size:0.875rem; border-radius:var(--r-full); white-space:nowrap;">
                <x-icon name="sparkles" /> Dashboard
            </a>
            <a href="{{ route('admin.destinasi.index') }}" class="btn {{ request()->routeIs('admin.destinasi.*') ? 'btn-primary' : 'btn-outline' }}" style="padding:0.55rem 1.15rem; font-size:0.875rem; border-radius:var(--r-full); white-space:nowrap;">
                <x-icon name="mountain" /> Destinasi Wisata
            </a>
            <a href="{{ route('admin.budaya.index') }}" class="btn {{ request()->routeIs('admin.budaya.*') ? 'btn-primary' : 'btn-outline' }}" style="padding:0.55rem 1.15rem; font-size:0.875rem; border-radius:var(--r-full); white-space:nowrap;">
                <x-icon name="book" /> Etika Budaya
            </a>
            <a href="{{ route('admin.kalender.index') }}" class="btn {{ request()->routeIs('admin.kalender.*') ? 'btn-primary' : 'btn-outline' }}" style="padding:0.55rem 1.15rem; font-size:0.875rem; border-radius:var(--r-full); white-space:nowrap;">
                <x-icon name="calendar" /> Kalender Agama
            </a>
            <a href="{{ route('admin.ulasan.index') }}" class="btn {{ request()->routeIs('admin.ulasan.*') ? 'btn-primary' : 'btn-outline' }}" style="padding:0.55rem 1.15rem; font-size:0.875rem; border-radius:var(--r-full); white-space:nowrap;">
                <x-icon name="chat" /> Moderasi Ulasan
            </a>
        </div>

        <!-- Flash Alert -->
        @if (session('success'))
            <div style="background:#ecfdf5; border:1.5px solid #a7f3d0; color:#065f46; padding:0.9rem 1.25rem; border-radius:var(--r-md); margin-bottom:1.5rem; display:flex; align-items:center; gap:0.5rem; font-weight:600;">
                <x-icon name="check" /> <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div style="background:#fef2f2; border:1.5px solid #fecaca; color:#991b1b; padding:0.9rem 1.25rem; border-radius:var(--r-md); margin-bottom:1.5rem;">
                <strong style="display:block; margin-bottom:0.25rem;">Terjadi kesalahan:</strong>
                <ul style="margin:0; padding-left:1.2rem; font-size:0.9rem;">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main Content Area -->
        @yield('admin-content')
    </div>
</section>
@endsection
