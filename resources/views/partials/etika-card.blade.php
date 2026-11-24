@php
    $ikon = match ($budaya->slug) {
        'busana-pura' => 'shirt',
        'canang-sari' => 'flower',
        'nyepi' => 'moon',
        'basa-bali' => 'chat',
        'adat-laut' => 'waves',
        'pantang-larang-desa' => 'ban',
        default => 'info',
    };
@endphp

<div class="etika-card">
    <div class="etika-top">
        <div class="etika-ico"><x-icon :name="$ikon" /></div>
        <h3>{{ $budaya->judul }}</h3>
    </div>
    <p>{{ $budaya->ringkas }}</p>
    <a href="{{ route('etika.show', $budaya->slug) }}" class="link-more">
        Baca selengkapnya <x-icon name="arrow-right" />
    </a>
</div>
