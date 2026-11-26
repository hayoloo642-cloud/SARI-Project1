@extends('admin.layout', ['title' => 'Dashboard', 'headerTitle' => 'Ringkasan Sistem'])

@section('admin-content')
<div class="values" style="margin-bottom: 2.5rem;">
    <article class="value">
        <div class="value-icon"><x-icon name="mountain" /></div>
        <h3>{{ $totalDestinasi }} Destinasi</h3>
        <p>Total destinasi terdaftar di seluruh 9 kabupaten/kota Bali.</p>
        <a href="{{ route('admin.destinasi.index') }}" class="btn btn-outline" style="margin-top:1rem; padding:0.4rem 0.9rem; font-size:0.8rem;">Kelola Destinasi &rarr;</a>
    </article>
    <article class="value">
        <div class="value-icon"><x-icon name="book" /></div>
        <h3>{{ $totalBudaya }} Panduan Etika</h3>
        <p>Aturan adat, tata cara pakaian pura, dan pedoman sopan santun.</p>
        <a href="{{ route('admin.budaya.index') }}" class="btn btn-outline" style="margin-top:1rem; padding:0.4rem 0.9rem; font-size:0.8rem;">Kelola Etika &rarr;</a>
    </article>
    <article class="value">
        <div class="value-icon"><x-icon name="calendar" /></div>
        <h3>{{ $totalKalender }} Hari Ritual</h3>
        <p>Jadwal perayaan hari suci, piodalan, dan upacara adat di Bali.</p>
        <a href="{{ route('admin.kalender.index') }}" class="btn btn-outline" style="margin-top:1rem; padding:0.4rem 0.9rem; font-size:0.8rem;">Kelola Kalender &rarr;</a>
    </article>
    <article class="value">
        <div class="value-icon"><x-icon name="chat" /></div>
        <h3>{{ $totalUlasanPending }} Ulasan Pending</h3>
        <p>Ulasan wisatawan yang butuh persetujuan sebelum tampil publik.</p>
        <a href="{{ route('admin.ulasan.index', ['status' => 'pending']) }}" class="btn btn-outline" style="margin-top:1rem; padding:0.4rem 0.9rem; font-size:0.8rem;">Moderasi Ulasan &rarr;</a>
    </article>
</div>

<div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(360px, 1fr)); gap: 2rem;">
    <!-- Destinasi Terbaru -->
    <div class="panel" style="padding: 1.5rem;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 1rem;">
            <h3 style="margin:0; font-size:1.15rem; color:var(--navy);">Destinasi Terbaru</h3>
            <a href="{{ route('admin.destinasi.create') }}" class="btn btn-primary" style="padding:0.4rem 0.85rem; font-size:0.8rem;">+ Tambah Baru</a>
        </div>
        <div style="display:flex; flex-direction:column; gap:0.75rem;">
            @forelse ($destinasiTerbaru as $d)
                <div style="display:flex; justify-content:space-between; align-items:center; padding:0.75rem; background:var(--blue-soft); border-radius:var(--r-md);">
                    <div>
                        <strong style="color:var(--navy); display:block;">{{ $d->nama }}</strong>
                        <span style="font-size:0.8rem; color:var(--muted);">{{ $d->wilayah->nama ?? '-' }} · {{ $d->kategori }}</span>
                    </div>
                    <div style="display:flex; gap:0.4rem;">
                        <a href="{{ route('admin.destinasi.edit', $d) }}" class="btn btn-outline" style="padding:0.35rem 0.7rem; font-size:0.75rem;">Edit</a>
                    </div>
                </div>
            @empty
                <p style="color:var(--muted); font-size:0.9rem;">Belum ada data destinasi.</p>
            @endforelse
        </div>
    </div>

    <!-- Ulasan Masuk -->
    <div class="panel" style="padding: 1.5rem;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 1rem;">
            <h3 style="margin:0; font-size:1.15rem; color:var(--navy);">Ulasan Terkini</h3>
            <a href="{{ route('admin.ulasan.index') }}" class="btn btn-outline" style="padding:0.4rem 0.85rem; font-size:0.8rem;">Lihat Semua</a>
        </div>
        <div style="display:flex; flex-direction:column; gap:0.75rem;">
            @forelse ($ulasanTerbaru as $u)
                <div style="padding:0.75rem; border:1px solid var(--line); border-radius:var(--r-md);">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.25rem;">
                        <strong style="font-size:0.9rem; color:var(--navy);">{{ $u->nama_pengunjung }}</strong>
                        <span class="badge-status {{ $u->status }}">{{ ucfirst($u->status) }}</span>
                    </div>
                    <div style="font-size:0.8rem; color:var(--muted); margin-bottom:0.4rem;">
                        Di <strong>{{ $u->destinasi->nama ?? '-' }}</strong> · Rating {{ $u->rating }}/5
                    </div>
                    <p style="font-size:0.85rem; margin:0; color:var(--text); line-height:1.4;">"{{ Str::limit($u->komentar, 90) }}"</p>
                </div>
            @empty
                <p style="color:var(--muted); font-size:0.9rem;">Belum ada ulasan masuk.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
