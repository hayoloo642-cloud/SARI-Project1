@extends('layouts.sari')

@section('title', 'SARI — Inti seni, adat, dan rasa Bali untuk wisatawan bijak')
@section('description', 'Temukan wisata lokal Bali di luar zona padat. Panduan etika budaya, destinasi asli, dan kontak langsung warga. Tanpa login, tanpa komisi.')

@section('content')
    <!-- Hero -->
    <section class="hero">
        <img class="hero-img" src="{{ asset('assets/images/hero.jpg') }}" alt="Lanskap sawah terasering Bali" onerror="this.remove()">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <span class="hero-tag">
                <x-icon name="location" />
                <span class="aksara">ᬩᬮᬶ</span> Wisata Lokal Bali
            </span>
            <h1>Temukan <em>Bali Asli</em>,<br>Di Luar Zona Padat</h1>
            <p>Destinasi dikelola warga, panduan etika budaya, dan kontak langsung tanpa perantara. Dirancang untuk wisatawan yang ingin menghormati adat dan membuat uangnya berdampak.</p>
            <div class="hero-actions">
                <a href="{{ route('destinasi.index') }}" class="btn btn-primary">Jelajahi Destinasi</a>
                <a href="{{ route('etika.index') }}" class="btn btn-ghost">Pelajari Etika Budaya</a>
            </div>
            <div class="hero-stats">
                <span class="stat-pill"><strong>{{ $totalDestinasi }}</strong> Destinasi Lokal</span>
                <span class="stat-pill"><strong>{{ $totalWilayah }}</strong> Wilayah Bali</span>
                <span class="stat-pill"><strong>0%</strong> Komisi Perantara</span>
            </div>
            <div class="hero-proof">
                <div class="avatar-stack" aria-hidden="true">
                    <span class="av-1">KS</span>
                    <span class="av-2">PG</span>
                    <span class="av-3">SU</span>
                    <span class="av-4">TJ</span>
                </div>
                <p><strong>Dipercaya {{ $totalDestinasi }} pengelola &amp; kelompok sadar wisata</strong><br>langsung di desa — tanpa perantara.</p>
            </div>
        </div>
    </section>

    <!-- Countdown hari raya -->
    <section class="section" style="margin-top: -4.2rem; padding-bottom: 0; position: relative; z-index: 6;">
        <div class="container" style="padding-left: 1.5rem; padding-right: 1.5rem;">
            <div class="countdown-strip" id="countdown-raya" aria-live="polite">
                <div class="countdown-intro">
                    <span class="kicker">
                        <x-icon name="calendar" />
                        Kalender Suci Bali
                    </span>
                    <h3>Hari Raya <em>Terdekat</em></h3>
                    <p>Panduan singkat etika untuk setiap upacara — <a href="{{ route('kalender.index') }}" class="cd-link">lihat sejarah &amp; panduan lengkap</a></p>
                </div>
                <div class="countdown-grid" id="countdown-grid">
                    @forelse ($hariRaya as $hr)
                        <div class="cd-item">
                            <span class="cd-nama">{{ $hr['nama'] }}</span>
                            <span class="cd-hari">{{ $hr['selisih'] > 0 ? $hr['selisih'] : ($hr['selisih'] === 0 ? 'HARI' : '—') }}</span>
                            <span class="cd-tgl">
                                @if ($hr['selisih'] > 0)
                                    hari lagi · {{ $hr['tanggal']->locale('id')->translatedFormat('j M Y') }}
                                @elseif ($hr['selisih'] === 0)
                                    INI · {{ $hr['tanggal']->locale('id')->translatedFormat('j M Y') }}
                                @else
                                    sudah lewat
                                @endif
                            </span>
                        </div>
                    @empty
                        <div class="cd-item"><span class="cd-nama">Belum ada data</span><span class="cd-hari">—</span><span class="cd-tgl">kalender</span></div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Nilai jual -->
    <section class="section">
        <div class="container">
            <div class="head">
                <span class="kicker">Mengapa SARI</span>
                <h2>Wisata yang <em>Berarti</em> untuk Semua</h2>
                <p>SARI menghubungkan wisatawan dengan keaslian Bali, sambil mendistribusikan manfaat pariwisata ke seluruh pelosok Pulau Dewata.</p>
            </div>

            <div class="values">
                <article class="value">
                    <div class="value-icon"><x-icon name="heart" /></div>
                    <h3>Untuk Warga Lokal</h3>
                    <p>Destinasi kecil di luar zona padat mendapat visibilitas. Uang pariwisata mengalir langsung ke warga, tanpa komisi perantara.</p>
                </article>
                <article class="value">
                    <div class="value-icon"><x-icon name="book" /></div>
                    <h3>Etika Budaya</h3>
                    <p>Panduan busana masuk pura, canang sari, aturan Nyepi, dan frasa Bahasa Bali agar kunjungan Anda penuh hormat.</p>
                </article>
                <article class="value">
                    <div class="value-icon"><x-icon name="info" /></div>
                    <h3>Ringan &amp; Tanpa Login</h3>
                    <p>Buka langsung di browser. Tanpa instalasi, tanpa iklan, dan tanpa pengumpulan data pribadi. Cepat bahkan di jaringan 4G.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- Destinasi unggulan -->
    <section class="section soft">
        <div class="container">
            <div class="head">
                <span class="kicker">Destinasi Unggulan</span>
                <h2>Tempat <em>Tenang</em> yang Layak Dikunjungi</h2>
                <p>Pilihan destinasi lokal dengan pemandangan indah, pengelola warga, dan suasana yang jauh dari keramaian.</p>
            </div>

            <div class="grid-cards">
                @foreach ($destinasiUnggulan as $destinasi)
                    @include('partials.card-destinasi', ['destinasi' => $destinasi])
                @endforeach
            </div>

            <div style="text-align:center; margin-top: 3rem;">
                <a href="{{ route('destinasi.index') }}" class="btn btn-primary">Lihat Semua Destinasi</a>
            </div>
        </div>
    </section>

    <!-- Etika budaya -->
    <section class="section">
        <div class="container">
            <div class="head">
                <span class="kicker">Etika Budaya</span>
                <h2>Hormati <em>Adat Bali</em> Sebelum Berangkat</h2>
                <p>Sedikit pemahaman membuat kunjungan Anda lebih bermakna dan dihormati warga setempat.</p>
            </div>

            <div class="etika-grid">
                @foreach ($budaya as $b)
                    @include('partials.etika-card', ['budaya' => $b])
                @endforeach
            </div>

            <div style="text-align:center; margin-top: 3rem;">
                <a href="{{ route('etika.index') }}" class="btn btn-outline">Lihat Semua Panduan Etika</a>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section" style="padding-top: 0;">
        <div class="container">
            <div class="cta-band">
                <h2>Siap Menjelajah Bali yang Sejati?</h2>
                <p>Lihat kalender hari suci sebelum merencanakan perjalanan, agar kunjungan Anda tepat waktu dan penuh hormat.</p>
                <a href="{{ route('kalender.index') }}" class="btn btn-primary">Cek Kalender Hari Suci</a>
            </div>
        </div>
    </section>
@endsection
