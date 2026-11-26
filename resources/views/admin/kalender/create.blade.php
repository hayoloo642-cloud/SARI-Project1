@extends('admin.layout', ['title' => 'Tambah Agenda Kalender', 'headerTitle' => 'Tambah Agenda Ritual Baru'])

@section('admin-content')
<div style="max-width: 760px;">
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('admin.kalender.index') }}" class="btn btn-outline" style="padding:0.4rem 0.85rem; font-size:0.85rem;">&larr; Kembali ke Daftar</a>
    </div>

    <form method="POST" action="{{ route('admin.kalender.store') }}" class="panel" style="padding: 2rem;">
        @csrf

        <div style="margin-bottom:1.25rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Nama Upacara / Hari Suci *</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="Contoh: Hari Raya Galungan" style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem;">
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1.25rem; margin-bottom:1.25rem;">
            <div>
                <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Tanggal Kalender (Teks) *</label>
                <input type="text" name="tanggal_teks" value="{{ old('tanggal_teks') }}" required placeholder="Contoh: 15 Januari 2027" style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem;">
            </div>
            <div>
                <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Tanggal ISO (YYYY-MM-DD) *</label>
                <input type="date" name="tanggal_iso" value="{{ old('tanggal_iso') }}" required style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem;">
            </div>
        </div>

        <div style="margin-bottom:1.25rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Keterangan &amp; Makna Ritual *</label>
            <textarea name="keterangan" rows="4" required placeholder="Jelaskan makna perayaan, tujuan doa, dan atmosfer pura..." style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem; font-family:inherit;">{{ old('keterangan') }}</textarea>
        </div>

        <div style="margin-bottom:1.25rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Saran untuk Wisatawan</label>
            <textarea name="saran" rows="3" placeholder="Saran pakaian, pembatasan akses jalan, waktu terbaik berkunjung..." style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem; font-family:inherit;">{{ old('saran') }}</textarea>
        </div>

        <div style="margin-bottom:1.5rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Latar Belakang / Sejarah (opsional)</label>
            <textarea name="sejarah" rows="3" placeholder="Asal mula tradisi atau sumber sastra keagamaan..." style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem; font-family:inherit;">{{ old('sejarah') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary" style="padding:0.75rem 2rem; font-size:0.95rem;">
            Simpan Agenda Kalender
        </button>
    </form>
</div>
@endsection
