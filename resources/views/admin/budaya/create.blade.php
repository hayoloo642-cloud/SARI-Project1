@extends('admin.layout', ['title' => 'Tambah Etika Budaya', 'headerTitle' => 'Tambah Panduan Etika Baru'])

@section('admin-content')
<div style="max-width: 760px;">
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('admin.budaya.index') }}" class="btn btn-outline" style="padding:0.4rem 0.85rem; font-size:0.85rem;">&larr; Kembali ke Daftar</a>
    </div>

    <form method="POST" action="{{ route('admin.budaya.store') }}" class="panel" style="padding: 2rem;">
        @csrf

        <div style="margin-bottom:1.25rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Judul Panduan *</label>
            <input type="text" name="judul" value="{{ old('judul') }}" required placeholder="Contoh: Tata Cara Berpakaian di Pura" style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem;">
        </div>

        <div style="margin-bottom:1.25rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Slug URL (opsional)</label>
            <input type="text" name="slug" value="{{ old('slug') }}" placeholder="Otomatis dari judul" style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem;">
        </div>

        <div style="margin-bottom:1.25rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Ringkasan Pendek *</label>
            <textarea name="ringkas" rows="3" required placeholder="Ringkasan 1-2 kalimat untuk kartu panduan..." style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem; font-family:inherit;">{{ old('ringkas') }}</textarea>
        </div>

        <div style="margin-bottom:1.5rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Penjelasan Detail &amp; Aturan *</label>
            <textarea name="detail" rows="7" required placeholder="Uraikan norma, larangan, anjuran, dan alasan budaya setempat..." style="width:100%; padding:0.75rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem; font-family:inherit;">{{ old('detail') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary" style="padding:0.75rem 2rem; font-size:0.95rem;">
            Simpan Panduan Etika
        </button>
    </form>
</div>
@endsection
