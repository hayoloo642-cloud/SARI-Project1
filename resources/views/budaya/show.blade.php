@extends('layouts.sari')

@section('title', $budaya->judul . ' — Etika Budaya Jejak Bali')
@section('description', Str::limit($budaya->ringkas, 155))

@section('content')
    <section class="hero sub">
        <img class="hero-img" src="{{ asset('assets/images/lempuyang.jpg') }}" alt="Pura di Bali" onerror="this.remove()">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <span class="hero-tag">
                <x-icon name="check" />
                Etika Budaya
            </span>
            <h1>{{ $budaya->judul }}</h1>
            <p>{{ $budaya->ringkas }}</p>
        </div>
    </section>

    <section class="section">
        <div class="container" style="max-width: 900px;">
            <div class="panel" style="padding: 2.2rem 2.4rem;">
                <p class="lead" style="font-size:1.08rem; color:var(--ink); margin-bottom:1.2rem;">{{ $budaya->ringkas }}</p>
                @if ($budaya->detail)
                    <div style="color:var(--muted); line-height:1.9;">
                        {!! nl2br(e($budaya->detail)) !!}
                    </div>
                @endif

                <div class="side-actions" style="margin-top:2rem; flex-direction:row; flex-wrap:wrap;">
                    <a href="{{ route('etika.index') }}" class="btn btn-outline">Semua Panduan Etika</a>
                    <a href="{{ route('destinasi.index') }}" class="btn btn-primary">Jelajahi Destinasi</a>
                </div>
            </div>
        </div>
    </section>

    @if ($budaya->destinasi->isNotEmpty())
        <section class="section soft" style="margin-top: 0;">
            <div class="container">
                <div class="head">
                    <span class="kicker">Terhubung</span>
                    <h2>Destinasi yang <em>Berkaitan</em></h2>
                    <p>Terapkan panduan ini saat mengunjungi tempat-tempat berikut.</p>
                </div>

                <div class="grid-cards">
                    @foreach ($budaya->destinasi as $destinasi)
                        @include('partials.card-destinasi', ['destinasi' => $destinasi])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
