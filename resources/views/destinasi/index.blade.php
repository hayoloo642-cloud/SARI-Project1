@extends('layouts.sari')

@section('title', 'Destinasi Lokal Bali — SARI')
@section('description', 'Daftar destinasi wisata lokal Bali di luar zona padat. Filter wilayah, cari destinasi, dan hubungi pengelola langsung.')

@push('head')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" defer></script>
@endpush

@section('content')
    <!-- Header -->
    <section class="hero sub">
        <img class="hero-img" src="{{ asset('assets/images/jatiluwih.jpg') }}" alt="Teras sawah Jatiluwih, Tabanan" onerror="this.remove()">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <span class="hero-tag">
                <x-icon name="location" />
                Destinasi Lokal
            </span>
            <h1>Wisata Lokal <em>Bali</em></h1>
            <p>Destinasi kecil di luar zona padat yang dikelola warga. Setiap kunjungan Anda langsung mendukung ekonomi desa.</p>
        </div>
    </section>

    <!-- Peta destinasi -->
    <section class="section" style="padding-bottom: 0;">
        <div class="container">
            <div class="map-box">
                <div class="map-head">
                    <div>
                        <h3>
                            <x-icon name="location" />
                            Peta Destinasi SARI
                        </h3>
                        <p class="map-hint">Klik penanda untuk melihat ringkas destinasi. Filter &amp; pencarian di bawah otomatis menyingkronkan peta.</p>
                    </div>
                    <a class="btn btn-outline" style="font-size:0.82rem; padding:0.55rem 1rem;" href="https://www.openstreetmap.org" target="_blank" rel="noopener">Peta © OpenStreetMap</a>
                </div>
                <div id="map-destinasi" class="map-frame" role="application" aria-label="Peta destinasi wisata lokal Bali"></div>
            </div>
        </div>
    </section>

    <script id="peta-destinasi-data" type="application/json">@json($petaDestinasi)</script>

    <section class="section">
        <div class="container">
            <!-- Pencarian -->
            <form method="GET" action="{{ route('destinasi.index') }}" class="search-container">
                @if ($wilayahSlug !== 'semua')
                    <input type="hidden" name="wilayah" value="{{ $wilayahSlug }}">
                @endif
                <div class="search-box-wrap">
                    <span class="search-icon-left" aria-hidden="true"><x-icon name="search" /></span>
                    <input type="text"
                           name="q"
                           value="{{ $q }}"
                           aria-label="Cari destinasi"
                           class="search-input-field"
                           placeholder="Cari destinasi, pura, pantai, air terjun..."
                           autocomplete="off">
                    @if ($q !== '')
                        <a href="{{ route('destinasi.index', ['wilayah' => $wilayahSlug]) }}" class="search-clear-btn" aria-label="Hapus pencarian" title="Hapus pencarian">&times;</a>
                    @endif
                </div>
            </form>

            <!-- Filter wilayah -->
            <div class="filters">
                <a href="{{ route('destinasi.index', ['q' => $q ?: null]) }}"
                   class="chip {{ $wilayahSlug === 'semua' ? 'aktif' : '' }}"
                   aria-pressed="{{ $wilayahSlug === 'semua' ? 'true' : 'false' }}">Semua Wilayah</a>

                @foreach ($wilayah as $w)
                    <a href="{{ route('destinasi.index', ['wilayah' => $w->slug, 'q' => $q ?: null]) }}"
                       class="chip {{ $wilayahSlug === $w->slug ? 'aktif' : '' }}"
                       aria-pressed="{{ $wilayahSlug === $w->slug ? 'true' : 'false' }}">{{ $w->nama }}</a>
                @endforeach
            </div>

            @if ($q !== '')
                <p style="color: var(--muted); font-size: 0.92rem; margin: -1rem 0 1.4rem;">
                    Hasil pencarian untuk <strong>&ldquo;{{ $q }}&rdquo;</strong> — {{ $destinasi->total() }} destinasi ditemukan.
                </p>
            @endif

            <!-- Grid -->
            @if ($destinasi->count() > 0)
                <div class="grid-cards">
                    @foreach ($destinasi as $item)
                        @include('partials.card-destinasi', ['destinasi' => $item])
                    @endforeach
                </div>

                @if ($destinasi->hasPages())
                    <nav class="sari-pagination" aria-label="Navigasi halaman">
                        @if ($destinasi->onFirstPage())
                            <span class="btn btn-outline" aria-disabled="true" style="opacity:.45; cursor:not-allowed;">Sebelumnya</span>
                        @else
                            <a href="{{ $destinasi->previousPageUrl() }}" class="btn btn-outline">Sebelumnya</a>
                        @endif

                        <span>Halaman {{ $destinasi->currentPage() }} dari {{ $destinasi->lastPage() }}</span>

                        @if ($destinasi->hasMorePages())
                            <a href="{{ $destinasi->nextPageUrl() }}" class="btn btn-outline">Berikutnya</a>
                        @else
                            <span class="btn btn-outline" aria-disabled="true" style="opacity:.45; cursor:not-allowed;">Berikutnya</span>
                        @endif
                    </nav>
                @endif
            @else
                <div class="empty-state">
                    <h3>Tidak ada destinasi</h3>
                    <p>Coba kata kunci lain atau pilih wilayah yang berbeda.</p>
                    <a class="btn btn-outline" style="margin-top:1.25rem;" href="{{ route('destinasi.index') }}">Reset Filter</a>
                </div>
            @endif
        </div>
    </section>
@endsection
