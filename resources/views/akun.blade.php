@extends('layouts.sari')

@section('title', 'Akun Saya — SARI')
@section('description', 'Profil akun SARI Anda dan daftar destinasi favorit yang tersimpan.')
@section('page', 'akun')

@section('content')
    @php($user = auth()->user())

    <section class="section" style="padding-top: 8rem;">
        <div class="container">
            <div class="akun-head">
                <div class="akun-identitas">
                    <div class="akun-avatar">{{ Str::upper(Str::substr($user->name, 0, 1)) }}</div>
                    <div>
                        <span class="kicker">Akun Pengunjung</span>
                        <h2 style="margin: 0.6rem 0 0.3rem;">{{ $user->name }}</h2>
                        <p style="color: var(--muted); margin: 0; font-size: 0.94rem;">
                            {{ $user->email }}
                            <span class="akun-dot" aria-hidden="true">·</span>
                            Bergabung {{ $user->created_at?->locale('id')->translatedFormat('F Y') }}
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline">Keluar</button>
                </form>
            </div>

            <div class="akun-ringkas">
                <div class="akun-stat">
                    <strong>{{ $bookmarks->count() }}</strong>
                    <span>Destinasi Favorit</span>
                </div>
                <div class="akun-stat">
                    <strong>{{ \App\Models\Ulasan::where('nama_pengunjung', $user->name)->count() }}</strong>
                    <span>Ulasan Terkirim</span>
                </div>
                <div class="akun-stat">
                    <strong>0%</strong>
                    <span>Komisi Perantara</span>
                </div>
            </div>

            <div class="akun-section-head">
                <div>
                    <span class="kicker">Tersimpan</span>
                    <h3 style="margin: 0.6rem 0 0.3rem;">Destinasi Favorit Saya</h3>
                    <p style="color: var(--muted); margin: 0; font-size: 0.94rem;">
                        Tempat yang Anda simpan untuk perjalanan berikutnya.
                    </p>
                </div>
                <a href="{{ route('destinasi.index') }}" class="btn btn-primary">Jelajahi Destinasi</a>
            </div>

            @if ($bookmarks->isEmpty())
                <div class="empty-state" style="background: var(--bg-soft); border-radius: var(--r-lg); padding: 3rem 1.5rem;">
                    <h3>Belum ada favorit</h3>
                    <p>Tekan ikon hati pada kartu destinasi untuk menyimpannya di sini.</p>
                    <a class="btn btn-outline" style="margin-top: 1.25rem;" href="{{ route('destinasi.index') }}">Cari Destinasi</a>
                </div>
            @else
                <div class="grid-cards">
                    @foreach ($bookmarks as $bookmark)
                        @include('partials.card-destinasi', ['destinasi' => $bookmark->destinasi])
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
