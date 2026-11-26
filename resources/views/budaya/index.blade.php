@extends('layouts.sari')

@section('title', 'Etika Budaya Bali — Jejak Bali')
@section('description', 'Panduan etika wisatawan Bali: busana masuk pura, canang sari, aturan Nyepi, Bahasa Bali dasar, dan adat laut.')

@section('content')
    <section class="hero sub">
        <img class="hero-img" src="{{ asset('assets/images/lempuyang.jpg') }}" alt="Gerbang Pura Lempuyang, Karangasem" onerror="this.remove()">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <span class="hero-tag">
                <x-icon name="check" />
                Etika Budaya
            </span>
            <h1>Hormati <em>Adat Bali</em></h1>
            <p>Panduan lengkap agar kunjungan Anda nyaman, menghormati norma lokal, dan tidak menjadi beban bagi warga.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="etika-grid">
                @foreach ($budaya as $b)
                    @include('partials.etika-card', ['budaya' => $b])
                @endforeach
            </div>
        </div>
    </section>

    <section class="section" style="padding-top: 0;">
        <div class="container">
            <div class="cta-band">
                <h2>Siap Kunjungan yang Penuh Hormat?</h2>
                <p>Lihat destinasi lokal dan terapkan etika yang telah Anda pelajari di setiap perhentian.</p>
                <a href="{{ route('destinasi.index') }}" class="btn btn-primary">Lihat Destinasi Lokal</a>
            </div>
        </div>
    </section>
@endsection
