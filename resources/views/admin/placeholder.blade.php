@extends('layouts.sari')

@section('title', 'Panel Admin — SARI')
@section('description', 'Ringkasan panel SARI: destinasi, ulasan menunggu moderasi, dan kontributor.')

@section('content')
    <section class="section" style="padding-top: 8rem;">
        <div class="container">
            <div class="admin-head">
                <div>
                    <span class="kicker">Panel Kontributor</span>
                    <h2 style="margin: 0.8rem 0 0.5rem;">Halo, {{ Str::of(auth()->user()->name)->explode(' ')->first() }}</h2>
                    <p style="color: var(--muted); margin: 0;">
                        Anda masuk sebagai <strong>{{ auth()->user()->role }}</strong>. Ringkasan data SARI ada di bawah ini.
                    </p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline">Keluar</button>
                </form>
            </div>

            <div class="values" style="margin-bottom: 3rem;">
                <article class="value">
                    <div class="value-icon"><x-icon name="mountain" /></div>
                    <h3>{{ $totalDestinasi }} Destinasi</h3>
                    <p>Total destinasi yang terdaftar di SARI, termasuk yang belum tayang di halaman publik.</p>
                </article>
                <article class="value">
                    <div class="value-icon"><x-icon name="star" /></div>
                    <h3>{{ $totalUlasanPending }} Ulasan Pending</h3>
                    <p>Ulasan pengunjung menunggu persetujuan sebelum tampil di halaman destinasi.</p>
                </article>
                <article class="value">
                    <div class="value-icon"><x-icon name="user" /></div>
                    <h3>{{ $totalKontributor }} Kontributor</h3>
                    <p>Pengelola desa dan kelompok sadar wisata yang membantu merawat data destinasi.</p>
                </article>
            </div>

            <div class="panel" style="padding: 1.8rem;">
                <h3><x-icon name="chat" /> Ulasan Terbaru</h3>

                @if ($ulasanTerbaru->isEmpty())
                    <p style="color: var(--muted); margin: 0;">Belum ada ulasan pengunjung.</p>
                @else
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Pengunjung</th>
                                    <th>Destinasi</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ulasanTerbaru as $u)
                                    <tr>
                                        <td>{{ $u->nama_pengunjung }}</td>
                                        <td>{{ $u->destinasi->nama ?? '—' }}</td>
                                        <td>{{ $u->rating }}/5</td>
                                        <td><span class="badge-status {{ $u->status }}">{{ ucfirst($u->status) }}</span></td>
                                        <td>{{ $u->created_at?->locale('id')->translatedFormat('j M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div class="admin-note">
                <x-icon name="info" />
                <p>Panel pengelolaan penuh — CRUD destinasi, moderasi ulasan, dan statistik kunjungan — sedang disiapkan pada tahap berikutnya. Untuk saat ini, data dapat dikelola melalui API <code>/api</code>.</p>
            </div>
        </div>
    </section>
@endsection
