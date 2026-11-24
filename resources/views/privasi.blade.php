@extends('layouts.sari')

@section('title', 'Kebijakan Privasi — SARI')
@section('description', 'Kebijakan privasi SARI: data apa yang dikumpulkan, bagaimana digunakan, dan hak Anda.')

@section('content')
    <section class="section" style="padding-top: 7rem;">
        <div class="container" style="max-width: 820px;">
            <div class="head left">
                <span class="kicker">Privasi</span>
                <h2>Kebijakan <em>Privasi</em></h2>
            </div>

            <div class="panel" style="padding: 2rem; line-height: 1.85; color: var(--muted);">
                <h3 style="color: var(--navy);">Data yang Kami Kumpulkan</h3>
                <p>SARI tidak mewajibkan login untuk menjelajah destinasi. Kami hanya menyimpan nama dan komentar yang Anda kirimkan secara sukarela melalui formulir ulasan, serta statistik kunjungan agregat per destinasi.</p>

                <h3 style="color: var(--navy);">Penggunaan Data</h3>
                <p>Ulasan digunakan untuk membantu wisatawan lain dan ditampilkan setelah melalui moderasi. Statistik kunjungan digunakan untuk memahami destinasi yang perlu dipromosikan. Kami tidak menjual data kepada pihak ketiga.</p>

                <h3 style="color: var(--navy);">Kontak</h3>
                <p>Pertanyaan tentang privasi dapat dikirim ke <a href="mailto:info@sari-bali.id" style="color: var(--blue); font-weight: 700;">info@sari-bali.id</a>.</p>
            </div>
        </div>
    </section>
@endsection
