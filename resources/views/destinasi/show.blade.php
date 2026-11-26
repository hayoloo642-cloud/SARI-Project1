@extends('layouts.sari')

@section('title', $destinasi->nama . ' — Jejak Bali')
@section('description', Str::limit($destinasi->deskripsi, 155))
@section('og_image', $destinasi->gambar ? (Str::startsWith($destinasi->gambar, ['http://', 'https://']) ? $destinasi->gambar : asset($destinasi->gambar)) : asset('assets/images/hero.jpg'))

@php
    $kategori = strtolower($destinasi->kategori ?? '');

    $ikonKategori = match (true) {
        str_contains($kategori, 'pantai'), str_contains($kategori, 'nelayan') => 'waves',
        str_contains($kategori, 'pura') => 'temple',
        str_contains($kategori, 'sawah'), str_contains($kategori, 'subak') => 'wheat',
        str_contains($kategori, 'air terjun') => 'droplet',
        str_contains($kategori, 'hutan'), str_contains($kategori, 'mangrove') => 'leaf',
        default => 'mountain',
    };

    $pathGambar = $destinasi->gambar
        ? (Str::startsWith($destinasi->gambar, ['http://', 'https://']) ? $destinasi->gambar : asset($destinasi->gambar))
        : null;

    $wa = $destinasi->whatsapp ? preg_replace('/\D+/', '', $destinasi->whatsapp) : null;
    if ($wa && str_starts_with($wa, '0')) {
        $wa = '62' . substr($wa, 1);
    }

    $waPengelola = $destinasi->pengelola_wa ? preg_replace('/\D+/', '', $destinasi->pengelola_wa) : null;
    if ($waPengelola && str_starts_with($waPengelola, '0')) {
        $waPengelola = '62' . substr($waPengelola, 1);
    }

    $paragraf = $destinasi->detail->isNotEmpty()
        ? $destinasi->detail->pluck('paragraf')
        : collect([$destinasi->deskripsi]);

    $galeri = $destinasi->galeri;
    $jumlahBintang = (int) round($rating);
@endphp

@php
    $mapsDirectUrl = $destinasi->maps_url ?: (((float)$destinasi->latitude && (float)$destinasi->longitude) ? "https://www.google.com/maps/search/?api=1&query={$destinasi->latitude},{$destinasi->longitude}" : "https://www.google.com/maps/search/?api=1&query=" . urlencode($destinasi->nama . ' Bali'));
@endphp

@section('content')
    <section class="section" style="padding-top: 2.5rem;">
        <div class="container">
            <div class="detail-hero">
                <div class="ph-fallback">
                    <x-icon :name="$ikonKategori" />
                    <span>{{ $destinasi->nama }}</span>
                </div>
                @if ($pathGambar)
                    <img src="{{ $pathGambar }}" alt="{{ $destinasi->nama }}" onerror="this.remove()">
                @endif
                <div class="detail-hero-cap">
                    <h1>{{ $destinasi->nama }}</h1>
                    <div class="detail-meta">
                        <a href="{{ $mapsDirectUrl }}" target="_blank" rel="noopener" style="color:#fff; display:inline-flex; align-items:center; gap:0.35rem; text-decoration:none;" title="Buka di Google Maps">
                            <x-icon name="location" /> <span>{{ $destinasi->wilayah->nama ?? 'Bali' }} (Buka Maps &rarr;)</span>
                        </a>
                        <span><x-icon name="clock" /> {{ $destinasi->jam_buka ?: 'Sepanjang hari' }}</span>
                        <span><x-icon name="star" /> {{ number_format($rating, 1) }}</span>
                        <button type="button"
                                class="btn-bookmark-detail btn-bookmark"
                                data-destinasi-id="{{ $destinasi->id }}"
                                data-slug="{{ $destinasi->slug }}"
                                style="background:#fff; border:none; border-radius:var(--r-full); padding:0.35rem 0.9rem; font-size:0.85rem; font-weight:700; cursor:pointer; color:var(--navy); box-shadow:var(--sh-sm); margin-left:auto; display:inline-flex; align-items:center; gap:0.4rem;">
                            <x-icon name="heart" /> <span>Simpan Favorit</span>
                        </button>
                    </div>
                </div>
                @if ($destinasi->gambar_kredit)
                    <div style="font-size:0.75rem; color:var(--text-light); margin-top:0.4rem; display:flex; justify-content:flex-end; gap:0.4rem; align-items:center;">
                        <span>Foto: {{ $destinasi->gambar_kredit }}</span>
                        @if ($destinasi->gambar_sumber)
                            · <a href="{{ $destinasi->gambar_sumber }}" target="_blank" rel="noopener" style="color:var(--text-light); text-decoration:underline;">Sumber</a>
                        @endif
                    </div>
                @endif
            </div>

            <div class="detail-grid">
                <div class="detail-content">
                    <h2>Tentang Tempat Ini</h2>
                    @foreach ($paragraf as $p)
                        <p class="{{ $loop->first ? 'lead' : '' }}">{{ $p }}</p>
                    @endforeach

                    @if ($destinasi->highlight->isNotEmpty())
                        <h3>Sorotan Utama</h3>
                        <ul class="check-list">
                            @foreach ($destinasi->highlight as $h)
                                <li><x-icon name="check" /><span>{{ $h->teks }}</span></li>
                            @endforeach
                        </ul>
                    @endif

                    @if ($destinasi->aktivitas->isNotEmpty())
                        <h3>Aktivitas Populer</h3>
                        <div class="chip-line">
                            @foreach ($destinasi->aktivitas as $a)
                                <span class="chip-soft">{{ $a->nama }}</span>
                            @endforeach
                        </div>
                    @endif

                    @if ($galeri->isNotEmpty())
                        <div style="margin-top:2.6rem;">
                            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:0.4rem;">
                                <h3 style="margin:0;">Galeri Foto &amp; Dokumentasi</h3>
                                <span style="font-size:0.82rem; color:var(--muted); font-weight:600;">{{ $galeri->count() }} Foto</span>
                            </div>
                            <p style="color:var(--muted); font-size:0.9rem; margin-bottom:1rem;">Geser foto ke samping atau klik untuk memperbesar dokumentasi tempat ini.</p>
                            <div class="detail-galeri-slider">
                                <div class="detail-galeri-track">
                                    @foreach ($galeri as $g)
                                        @php
                                            $pathGaleri = Str::startsWith($g->path, ['http://', 'https://']) ? $g->path : asset($g->path);
                                        @endphp
                                        <div class="detail-galeri-slide"
                                             data-lightbox-src="{{ $pathGaleri }}"
                                             data-lightbox-alt="{{ $g->alt ?: $destinasi->nama }}"
                                             title="{{ $g->alt ?: $destinasi->nama }}">
                                            <img src="{{ $pathGaleri }}" alt="{{ $g->alt ?: $destinasi->nama }}" loading="lazy">
                                            <div class="galeri-overlay"><span>{{ $g->alt ?: $destinasi->nama }}</span></div>
                                            <div class="galeri-zoom-badge" aria-hidden="true"><x-icon name="search" /></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($destinasi->budaya->isNotEmpty())
                        <div style="margin-top:2.6rem;">
                            <h3>Budaya &amp; Etika Terkait</h3>
                            <div class="chip-line">
                                @foreach ($destinasi->budaya as $b)
                                    <a href="{{ route('etika.show', $b->slug) }}" class="chip-soft">{{ $b->judul }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Ulasan -->
                    <div class="reviews-section panel">
                        <div class="reviews-header">
                            <div>
                                <h3 style="display:flex; align-items:center; gap:0.5rem; margin-bottom:0.35rem;">
                                    <x-icon name="star" /> <span>Ulasan &amp; Penilaian Wisatawan</span>
                                </h3>
                                <p style="color:var(--muted); font-size:0.92rem; margin:0;">
                                    Pengalaman dan rekomendasi asli dari pengunjung yang telah menjelajahi tempat ini.
                                </p>
                            </div>
                            <div class="rating-badge-large">
                                <div class="score">{{ number_format($rating, 1) }}</div>
                                <div>
                                    <div class="stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="{{ $i <= $jumlahBintang ? '#f59e0b' : '#e2e8f0' }}" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                        @endfor
                                    </div>
                                    <div class="count">{{ $ulasan->count() }} Ulasan</div>
                                </div>
                            </div>
                        </div>

                        <div class="reviews-list" id="daftar-ulasan">
                            @forelse ($ulasan as $u)
                                <div class="review-card">
                                    <div class="review-card-top">
                                        <div class="review-author">
                                            <div class="review-avatar">{{ Str::upper(Str::substr($u->nama_pengunjung, 0, 1)) }}</div>
                                            <div class="review-author-name">{{ $u->nama_pengunjung }}</div>
                                        </div>
                                        <div class="review-meta-right">
                                            <div class="review-stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="{{ $i <= $u->rating ? '#f59e0b' : '#e2e8f0' }}" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                                @endfor
                                            </div>
                                            <span class="review-date">{{ $u->created_at?->locale('id')->translatedFormat('j M Y') }}</span>
                                        </div>
                                    </div>
                                    <p class="review-comment">{{ $u->komentar }}</p>
                                </div>
                            @empty
                                <div style="text-align:center; padding:2rem 1.2rem; color:var(--muted); font-size:0.95rem; background:#ffffff; border-radius:var(--r-md); border:1.5px dashed var(--line);">
                                    Belum ada ulasan untuk tempat ini. Jadilah yang pertama membagikan ulasan dan penilaian Anda!
                                </div>
                            @endforelse
                        </div>

                        <div class="write-review-card">
                            <h4><x-icon name="star" /> <span>Tulis Ulasan Anda</span></h4>
                            <p style="color:var(--muted); font-size:0.9rem; margin-bottom:1.1rem;">
                                Ulasan Anda membantu wisatawan lain menghargai tempat ini dan mendukung ekonomi warga lokal. Ulasan akan tampil setelah disetujui pengelola.
                            </p>
                            <form id="form-ulasan" data-destinasi-id="{{ $destinasi->id }}">
                                <div class="review-form-row">
                                    <input type="text" id="ulasan-nama" class="form-control" placeholder="Nama Anda" required maxlength="255"
                                           style="padding:0.75rem 0.95rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-family:inherit; font-size:0.95rem; width:100%; box-sizing:border-box;">
                                    <select id="ulasan-rating" style="padding:0.75rem 0.95rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-family:inherit; font-size:0.92rem; font-weight:600; cursor:pointer; width:100%; box-sizing:border-box;">
                                        <option value="5">5 — Luar biasa</option>
                                        <option value="4">4 — Sangat bagus</option>
                                        <option value="3">3 — Bagus</option>
                                        <option value="2">2 — Cukup</option>
                                        <option value="1">1 — Kurang</option>
                                    </select>
                                </div>
                                <textarea id="ulasan-komentar" rows="3" placeholder="Ceritakan pengalaman Anda di tempat ini..." required maxlength="5000"
                                          style="width:100%; box-sizing:border-box; padding:0.75rem 0.95rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-family:inherit; font-size:0.95rem; margin-bottom:0.8rem;"></textarea>
                                <div id="ulasan-pesan" style="font-size:0.9rem; margin-bottom:0.8rem; display:none;"></div>
                                <button type="submit" id="btn-submit-ulasan" class="btn btn-primary" style="padding:0.75rem 1.6rem; font-size:0.92rem;">Kirim Ulasan</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="sidebar">
                    <div class="panel">
                        <h3><x-icon name="info" /> Informasi Praktis</h3>
                        <div class="info-row"><span class="k">Kategori</span><span class="v">{{ $destinasi->kategori ?: '-' }}</span></div>
                        <div class="info-row"><span class="k">Waktu Terbaik</span><span class="v">{{ $destinasi->waktu_terbaik ?: '-' }}</span></div>
                        <div class="info-row"><span class="k">Jam Buka</span><span class="v">{{ $destinasi->jam_buka ?: '-' }}</span></div>
                        <div class="info-row"><span class="k">Tarif</span><span class="v">{{ $destinasi->tarif ?: 'Gratis' }}</span></div>
                        <div class="info-row"><span class="k">Kontak</span><span class="v">{{ $destinasi->kontak ?: '-' }}</span></div>
                        <div class="info-row"><span class="k">Cara Masuk</span><span class="v">{{ $destinasi->cara_masuk ?: '-' }}</span></div>
                        @if ($destinasi->maps_url)
                            <div class="info-row" style="margin-top:0.6rem; padding-top:0.6rem; border-top:1px dashed var(--line);">
                                <span class="k">Peta Lokasi</span>
                                <a href="{{ $destinasi->maps_url }}" target="_blank" rel="noopener" style="color:var(--blue); font-weight:700; text-decoration:underline; font-size:0.88rem; display:inline-flex; align-items:center; gap:0.3rem;">
                                    <x-icon name="map-pin" /> Buka di Google Maps
                                </a>
                            </div>
                        @endif
                    </div>

                    @if ((float) $destinasi->latitude !== 0.0 && (float) $destinasi->longitude !== 0.0)
                        <div class="panel" style="padding:1.1rem;">
                            <h3 style="margin-bottom:0.7rem;"><x-icon name="location" /> Peta Lokasi</h3>
                            <iframe title="Peta lokasi {{ $destinasi->nama }}"
                                    src="https://www.openstreetmap.org/export/embed.html?bbox={{ $destinasi->longitude - 0.045 }}%2C{{ $destinasi->latitude - 0.032 }}%2C{{ $destinasi->longitude + 0.045 }}%2C{{ $destinasi->latitude + 0.032 }}&amp;layer=mapnik&amp;marker={{ $destinasi->latitude }}%2C{{ $destinasi->longitude }}"
                                    style="width:100%; height:180px; border:0; border-radius:var(--r-md); display:block;"
                                    loading="lazy" referrerpolicy="no-referrer"></iframe>
                        </div>
                    @endif

                    <div class="panel">
                        <h3><x-icon name="check" /> Etika di Tempat Ini</h3>
                        <p style="color: var(--muted); font-size: 0.93rem; line-height: 1.75; margin: 0;">{{ $destinasi->etika ?: 'Hormati adat setempat, berpakaian sopan, dan jaga kebersihan lingkungan.' }}</p>
                    </div>

                    @if ($destinasi->pengelola_nama)
                        <div class="pengelola-card">
                            <div class="pg-avatar">{{ Str::upper(Str::substr(trim($destinasi->pengelola_nama), 0, 1)) }}</div>
                            <div style="min-width:0;">
                                <span class="pg-lbl">Dikelola oleh warga</span>
                                <div class="pg-nama">{{ $destinasi->pengelola_nama }}</div>
                            </div>
                            @if ($waPengelola)
                                <a class="pg-wa" href="https://wa.me/{{ $waPengelola }}" target="_blank" rel="noopener"><x-icon name="wa" /> <span>WA</span></a>
                            @endif
                        </div>
                    @endif

                    <div class="side-actions">
                        @if ($wa)
                            <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener" class="btn-wa"><x-icon name="wa" /> Hubungi via WhatsApp</a>
                        @else
                            <button class="btn-wa" disabled><x-icon name="info" /> WhatsApp Tidak Tersedia</button>
                        @endif
                        <a href="{{ route('destinasi.index') }}" class="btn-back">Kembali ke Destinasi</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
