@extends('layouts.sari')

@section('title', 'Kalender Agama Bali — Jejak Bali')
@section('description', 'Kalender hari suci Bali: Nyepi, Galungan, Kuningan, Saraswati dengan keterangan apa yang buka dan tutup.')

@section('content')
    <section class="hero sub">
        <img class="hero-img" src="{{ asset('assets/images/tirta-gangga.jpg') }}" alt="Taman Tirta Gangga, Karangasem" onerror="this.remove()">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <span class="hero-tag">
                <x-icon name="calendar" />
                Kalender Agama
            </span>
            <h1>Kalender <em>Hari Suci Bali</em></h1>
            <p>Tahu kapan hari suci, apa yang tutup, dan saran bagi wisatawan agar tidak kaget saat tiba di lokasi.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="kal-grid">
                @foreach ($kalender as $row)
                    @php($k = $row['item'])
                    <div class="kal-card">
                        <span class="kal-tag">Hari Suci</span>
                        <h3>{{ $k->nama }}</h3>
                        <p class="row">
                            <strong><x-icon name="calendar" /> Tanggal</strong>
                            <span>
                                {{ $k->tanggal_teks ?: '-' }}
                                @if ($row['selisih'] !== null)
                                    <br><small style="color:var(--muted);">
                                        @if ($row['selisih'] > 0) {{ $row['selisih'] }} hari lagi
                                        @elseif ($row['selisih'] === 0) Hari ini
                                        @else Sudah lewat
                                        @endif
                                    </small>
                                @endif
                            </span>
                        </p>
                        <p class="row"><strong><x-icon name="info" /> Makna</strong><span>{{ $k->keterangan ?: '-' }}</span></p>
                        <p class="row"><strong><x-icon name="check" /> Panduan Wisatawan</strong><span>{{ $k->saran ?: '-' }}</span></p>
                        @if ($k->sejarah)
                            <div class="sejarah">
                                <strong style="display:flex; align-items:center; gap:0.35rem; font-size:0.88rem; color:var(--navy); margin-bottom:0.4rem;">
                                    <x-icon name="book" /> <span>Sejarah &amp; Asal-Usul Ritual:</span>
                                </strong>
                                <p style="font-size:0.86rem; color:var(--ink); line-height:1.65; margin:0; text-align:justify;">{{ $k->sejarah }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="note">
                <h3>Penting: Hari Nyepi</h3>
                <p>Pada Hari Nyepi, seluruh aktivitas di Bali berhenti selama 24 jam. Tidak ada penerbangan, tidak ada aktivitas di jalan, dan lampu harus redup. Wisatawan diharapkan tinggal di dalam akomodasi dan mematuhi aturan setempat.</p>
            </div>
        </div>
    </section>
@endsection
