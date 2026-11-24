@extends('layouts.sari')

@section('title', 'Tentang SARI — Wisata Lokal Bali')
@section('description', 'SARI menghubungkan wisatawan dengan destinasi lokal Bali yang dikelola warga desa adat, tanpa komisi dan tanpa perantara.')

@section('content')
    <section class="hero sub">
        <img class="hero-img" src="{{ asset('assets/images/sidemen.jpg') }}" alt="Lanskap desa Sidemen, Bali" onerror="this.remove()">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <span class="hero-tag">
                <x-icon name="globe" />
                Tentang SARI
            </span>
            <h1>Siapa Kami, <em>Untuk Siapa</em></h1>
            <p>Platform wisata lokal Bali yang dikurasi bersama warga desa adat — tanpa komisi, tanpa iklan, tanpa perantara.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="head left">
                <span class="kicker">Misi Kami</span>
                <h2>SARI untuk <em>Bali</em></h2>
                <p>SARI adalah singkatan dari seni, adat, dan rasa Bali. Kami percaya pariwisata yang baik adalah pariwisata yang menghormati warga, adat, dan alam — sekaligus memberi manfaat ekonomi yang adil.</p>
            </div>

            <div class="values">
                <article class="value">
                    <div class="value-icon"><x-icon name="leaf" /></div>
                    <h3>Lokal &amp; Berkelanjutan</h3>
                    <p>Destinasi dipilih bersama warga desa adat. Setiap kunjungan diarahkan untuk mendukung ekonomi lokal dan menjaga lingkungan.</p>
                </article>
                <article class="value">
                    <div class="value-icon"><x-icon name="book" /></div>
                    <h3>Etika Diutamakan</h3>
                    <p>Kami menyertakan panduan busana, persembahan, dan aturan adat di setiap destinasi agar wisatawan datang dengan pemahaman.</p>
                </article>
                <article class="value">
                    <div class="value-icon"><x-icon name="heart" /></div>
                    <h3>Tanpa Perantara</h3>
                    <p>Kontak pengelola tersedia langsung. Tidak ada komisi, tidak ada markup, dan tidak ada perantara yang mengambil bagian warga.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section" style="padding-top: 0;">
        <div class="container">
            <div class="cta-band">
                <h2>Mulai Jelajahi Bali yang Sejati</h2>
                <p>Temukan destinasi lokal yang dikelola warga, lengkap dengan panduan etika dan kontak langsung.</p>
                <a href="{{ route('destinasi.index') }}" class="btn btn-primary">Lihat Destinasi</a>
            </div>
        </div>
    </section>
@endsection
