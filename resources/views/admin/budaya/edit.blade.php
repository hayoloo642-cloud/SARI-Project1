@extends('admin.layout', ['title' => 'Edit Etika Budaya', 'headerTitle' => 'Edit Panduan Etika: ' . $budaya->judul])

@section('admin-content')
<div style="max-width: 760px;">
    <div style="margin-bottom: 1.5rem; display:flex; justify-content:space-between; align-items:center;">
        <a href="{{ route('admin.budaya.index') }}" class="btn btn-outline" style="padding:0.4rem 0.85rem; font-size:0.85rem;">&larr; Kembali ke Daftar</a>
        <a href="{{ route('etika.show', $budaya->slug) }}" target="_blank" class="btn btn-outline" style="padding:0.4rem 0.85rem; font-size:0.85rem;">Lihat Halaman Publik &rarr;</a>
    </div>

    <form method="POST" action="{{ route('admin.budaya.update', $budaya) }}" class="panel" style="padding: 2rem;">
        @csrf
        @method('PUT')

        <div style="margin-bottom:1.25rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Judul Panduan *</label>
            <input type="text" name="judul" value="{{ old('judul', $budaya->judul) }}" required style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem;">
        </div>

        <div style="margin-bottom:1.25rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Slug URL *</label>
            <input type="text" name="slug" value="{{ old('slug', $budaya->slug) }}" required style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem;">
        </div>

        <div style="margin-bottom:1.25rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Ringkasan Pendek *</label>
            <textarea name="ringkas" rows="3" required style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem; font-family:inherit;">{{ old('ringkas', $budaya->ringkas) }}</textarea>
        </div>

        <div style="margin-bottom:1.5rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Penjelasan Detail &amp; Aturan *</label>
            <textarea name="detail" rows="7" required style="width:100%; padding:0.75rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem; font-family:inherit;">{{ old('detail', $budaya->detail) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary" style="padding:0.75rem 2rem; font-size:0.95rem;">
            Perbarui Panduan Etika
        </button>
    </form>
</div>
@endsection
