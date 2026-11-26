@php
    $rating = number_format((float) ($destinasi->rating_awal ?? 0), 1);
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

    $kelasRate = $rating >= 4.5 ? 'rate-tinggi' : ($rating >= 4 ? 'rate-ok' : 'rate-rendah');
    $mapsDirectUrl = $destinasi->maps_url ?: (((float)$destinasi->latitude && (float)$destinasi->longitude) ? "https://www.google.com/maps/search/?api=1&query={$destinasi->latitude},{$destinasi->longitude}" : "https://www.google.com/maps/search/?api=1&query=" . urlencode($destinasi->nama . ' Bali'));
@endphp

<article class="card">
    <div class="card-photo">
        <a href="{{ route('destinasi.show', $destinasi->slug) }}" class="card-photo-link" aria-label="Lihat detail {{ $destinasi->nama }}" style="display:block; width:100%; height:100%;">
            <div class="ph-fallback">
                <x-icon :name="$ikonKategori" />
                <span>{{ $destinasi->nama }}</span>
            </div>
            @if ($pathGambar)
                <img src="{{ $pathGambar }}" alt="Foto {{ $destinasi->nama }} — destinasi wisata Bali" loading="lazy" onerror="this.remove()">
            @endif
        </a>
        <span class="card-badge">{{ $destinasi->kategori ?: 'Destinasi' }}</span>
        <div class="card-top-right">
            <span class="card-rate {{ $kelasRate }}"><x-icon name="star" /> {{ $rating }}</span>
            <button type="button"
                    class="card-bookmark-btn btn-bookmark"
                    data-destinasi-id="{{ $destinasi->id }}"
                    data-slug="{{ $destinasi->slug }}"
                    aria-label="Simpan Favorit"
                    title="Simpan Favorit">
                <x-icon name="heart" />
            </button>
        </div>
    </div>
    <div class="card-body">
        <h3><a href="{{ route('destinasi.show', $destinasi->slug) }}" style="color:inherit; text-decoration:none;">{{ $destinasi->nama }}</a></h3>
        <p class="desc">{{ Str::limit($destinasi->deskripsi, 120) }}</p>
        <div class="card-meta">
            <a href="{{ $mapsDirectUrl }}" target="_blank" rel="noopener" style="color:var(--text-light); text-decoration:none; display:inline-flex; align-items:center; gap:0.3rem;" title="Klik untuk petunjuk arah di Google Maps">
                <x-icon name="location" /> <span>{{ $destinasi->wilayah->nama ?? 'Bali' }} (Peta &rarr;)</span>
            </a>
        </div>
        <div class="card-actions">
            <a href="{{ route('destinasi.show', $destinasi->slug) }}" class="btn-card dark">Lihat Detail</a>
            @if ($wa)
                <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener" class="btn-card green"><x-icon name="wa" /> Hubungi</a>
            @else
                <button class="btn-card green" disabled><x-icon name="info" /> Tanpa Kontak</button>
            @endif
        </div>
    </div>
</article>
