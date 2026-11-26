@extends('admin.layout', ['title' => 'Edit Destinasi', 'headerTitle' => 'Edit Destinasi: ' . $destinasi->nama])

@section('admin-content')
<div style="max-width: 860px;">
    <div style="margin-bottom: 1.5rem; display:flex; justify-content:space-between; align-items:center;">
        <a href="{{ route('admin.destinasi.index') }}" class="btn btn-outline" style="padding:0.4rem 0.85rem; font-size:0.85rem;">&larr; Kembali ke Daftar</a>
        <a href="{{ route('destinasi.show', $destinasi->slug) }}" target="_blank" class="btn btn-outline" style="padding:0.4rem 0.85rem; font-size:0.85rem;">Lihat Halaman Publik &rarr;</a>
    </div>

    <form method="POST" action="{{ route('admin.destinasi.update', $destinasi) }}" enctype="multipart/form-data" class="panel" style="padding: 2rem;">
        @csrf
        @method('PUT')

        <div style="display:grid; grid-template-columns: 2fr 1fr; gap:1.25rem; margin-bottom:1.25rem;">
            <div>
                <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Nama Destinasi *</label>
                <input type="text" name="nama" value="{{ old('nama', $destinasi->nama) }}" required style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem;">
            </div>
            <div>
                <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Slug URL *</label>
                <input type="text" name="slug" value="{{ old('slug', $destinasi->slug) }}" required style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem;">
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap:1.25rem; margin-bottom:1.25rem;">
            <div>
                <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Wilayah *</label>
                <select name="wilayah_id" required style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem;">
                    @foreach ($wilayah as $w)
                        <option value="{{ $w->id }}" {{ old('wilayah_id', $destinasi->wilayah_id) == $w->id ? 'selected' : '' }}>{{ $w->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Kategori *</label>
                <input type="text" name="kategori" value="{{ old('kategori', $destinasi->kategori) }}" required style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem;">
            </div>
            <div>
                <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Status Publikasi *</label>
                <select name="status" required style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem;">
                    <option value="aktif" {{ old('status', $destinasi->status) == 'aktif' ? 'selected' : '' }}>Aktif (Tayang)</option>
                    <option value="draft" {{ old('status', $destinasi->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="nonaktif" {{ old('status', $destinasi->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
        </div>

        <div style="margin-bottom:1.25rem;">
            <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Deskripsi Lengkap *</label>
            <textarea name="deskripsi" rows="5" required style="width:100%; padding:0.75rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem; font-family:inherit;">{{ old('deskripsi', $destinasi->deskripsi) }}</textarea>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap:1.25rem; margin-bottom:1.25rem;">
            <div>
                <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Jam Operasional</label>
                <input type="text" name="jam_buka" value="{{ old('jam_buka', $destinasi->jam_buka) }}" style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem;">
            </div>
            <div>
                <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Tarif / Tiket Masuk</label>
                <input type="text" name="tarif" value="{{ old('tarif', $destinasi->tarif) }}" style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem;">
            </div>
            <div>
                <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Waktu Kunjungan Terbaik</label>
                <input type="text" name="waktu_terbaik" value="{{ old('waktu_terbaik', $destinasi->waktu_terbaik) }}" style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem;">
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1.25rem; margin-bottom:1.25rem;">
            <div>
                <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Akses &amp; Cara Masuk</label>
                <textarea name="cara_masuk" rows="3" style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem; font-family:inherit;">{{ old('cara_masuk', $destinasi->cara_masuk) }}</textarea>
            </div>
            <div>
                <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Etika Kunjungan &amp; Norma Adat</label>
                <textarea name="etika" rows="3" style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem; font-family:inherit;">{{ old('etika', $destinasi->etika) }}</textarea>
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap:1.25rem; margin-bottom:1.25rem;">
            <div>
                <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Latitude (Lintang)</label>
                <input type="number" step="any" name="latitude" value="{{ old('latitude', $destinasi->latitude) }}" style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem;">
            </div>
            <div>
                <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Longitude (Bujur)</label>
                <input type="number" step="any" name="longitude" value="{{ old('longitude', $destinasi->longitude) }}" style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem;">
            </div>
            <div>
                <label style="display:block; font-weight:700; margin-bottom:0.35rem; color:var(--navy); font-size:0.9rem;">Nama Pengelola / Desa</label>
                <input type="text" name="pengelola_nama" value="{{ old('pengelola_nama', $destinasi->pengelola_nama) }}" style="width:100%; padding:0.6rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.9rem;">
            </div>
        </div>

        <div style="background:var(--blue-soft); padding:1.25rem; border-radius:var(--r-md); margin-bottom:1.5rem;">
            <h4 style="margin:0 0 0.85rem; color:var(--navy); font-size:0.95rem;">Foto Cover Destinasi</h4>
            @if ($destinasi->gambar)
                <div style="margin-bottom:0.75rem; display:flex; align-items:center; gap:1rem;">
                    <img src="{{ asset($destinasi->gambar) }}" alt="Preview" style="width:120px; height:80px; object-fit:cover; border-radius:var(--r-sm);">
                    <div style="font-size:0.8rem; color:var(--muted);">
                        Path saat ini: <code>{{ $destinasi->gambar }}</code>
                    </div>
                </div>
            @endif
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; margin-bottom:0.85rem;">
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.3rem;">Ganti Berkas Foto (JPG/PNG, max 4MB)</label>
                    <input type="file" name="gambar" accept="image/*" style="width:100%; font-size:0.85rem;">
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.3rem;">Atau Path Foto Eksisting</label>
                    <input type="text" name="gambar_url" value="{{ old('gambar_url', $destinasi->gambar) }}" style="width:100%; padding:0.55rem 0.8rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.85rem;">
                </div>
            </div>
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.3rem;">Kredit Fotografer</label>
                    <input type="text" name="gambar_kredit" value="{{ old('gambar_kredit', $destinasi->gambar_kredit) }}" style="width:100%; padding:0.55rem 0.8rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.85rem;">
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.3rem;">Tautan Sumber Foto</label>
                    <input type="url" name="gambar_sumber" value="{{ old('gambar_sumber', $destinasi->gambar_sumber) }}" style="width:100%; padding:0.55rem 0.8rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.85rem;">
                </div>
            </div>
        </div>

        <div style="display:flex; justify-content:space-between; align-items:center;">
            <label style="display:inline-flex; align-items:center; gap:0.5rem; cursor:pointer;">
                <input type="checkbox" name="is_unggulan" value="1" {{ old('is_unggulan', $destinasi->is_unggulan) ? 'checked' : '' }}>
                <span style="font-size:0.9rem; font-weight:600; color:var(--navy);">Tandai sebagai Destinasi Unggulan</span>
            </label>

            <button type="submit" class="btn btn-primary" style="padding:0.75rem 2rem; font-size:0.95rem;">
                Perbarui Destinasi
            </button>
        </div>
    </form>
</div>
@endsection
