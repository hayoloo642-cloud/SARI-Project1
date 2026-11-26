@extends('admin.layout', ['title' => 'Destinasi Wisata', 'headerTitle' => 'Kelola Destinasi Wisata'])

@section('admin-content')
<div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem; margin-bottom:1.5rem;">
    <!-- Filter & Search -->
    <form method="GET" action="{{ route('admin.destinasi.index') }}" style="display:flex; gap:0.5rem; flex-wrap:wrap; align-items:center;">
        <input type="text" name="q" value="{{ $q }}" placeholder="Cari nama / kategori..." style="padding:0.55rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.875rem; min-width:220px;">
        <select name="wilayah_id" style="padding:0.55rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.875rem;">
            <option value="">Semua Wilayah</option>
            @foreach ($wilayah as $w)
                <option value="{{ $w->id }}" {{ (string)$wilayahId === (string)$w->id ? 'selected' : '' }}>{{ $w->nama }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-outline" style="padding:0.55rem 1rem; font-size:0.875rem;">Filter</button>
        @if ($q || $wilayahId)
            <a href="{{ route('admin.destinasi.index') }}" class="btn btn-ghost" style="padding:0.55rem 0.75rem; font-size:0.875rem;">Reset</a>
        @endif
    </form>

    <a href="{{ route('admin.destinasi.create') }}" class="btn btn-primary" style="padding:0.6rem 1.25rem; font-size:0.9rem;">
        + Tambah Destinasi
    </a>
</div>

<div class="panel" style="overflow:hidden; padding:0;">
    <div style="overflow-x:auto;">
        <table class="table-admin" style="width:100%; border-collapse:collapse; text-align:left; font-size:0.875rem;">
            <thead>
                <tr style="background:var(--blue-soft); border-bottom:1.5px solid var(--line); color:var(--navy);">
                    <th style="padding:0.85rem 1rem;">Foto</th>
                    <th style="padding:0.85rem 1rem;">Nama &amp; Wilayah</th>
                    <th style="padding:0.85rem 1rem;">Kategori</th>
                    <th style="padding:0.85rem 1rem;">Tarif</th>
                    <th style="padding:0.85rem 1rem;">Status</th>
                    <th style="padding:0.85rem 1rem; text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($destinasi as $d)
                    <tr style="border-bottom:1px solid var(--line);">
                        <td style="padding:0.75rem 1rem; width:70px;">
                            @if ($d->gambar)
                                <img src="{{ asset($d->gambar) }}" alt="{{ $d->nama }}" style="width:56px; height:42px; object-fit:cover; border-radius:var(--r-sm);" onerror="this.src='{{ asset('assets/images/hero.jpg') }}'">
                            @else
                                <div style="width:56px; height:42px; background:#e2e8f0; border-radius:var(--r-sm); display:flex; align-items:center; justify-content:center; color:#94a3b8; font-size:0.7rem;">No Pic</div>
                            @endif
                        </td>
                        <td style="padding:0.75rem 1rem;">
                            <strong style="color:var(--navy); font-size:0.95rem; display:block;">{{ $d->nama }}</strong>
                            <span style="color:var(--muted); font-size:0.8rem;">
                                {{ $d->wilayah->nama ?? '-' }} · <code>/destinasi/{{ $d->slug }}</code>
                            </span>
                        </td>
                        <td style="padding:0.75rem 1rem;">
                            <span style="background:var(--blue-soft); color:var(--blue); padding:0.25rem 0.6rem; border-radius:var(--r-full); font-size:0.75rem; font-weight:600;">
                                {{ $d->kategori }}
                            </span>
                        </td>
                        <td style="padding:0.75rem 1rem; color:var(--text);">
                            {{ $d->tarif ?: 'Gratis / Sukarela' }}
                        </td>
                        <td style="padding:0.75rem 1rem;">
                            <span class="badge-status {{ $d->status }}">{{ ucfirst($d->status) }}</span>
                        </td>
                        <td style="padding:0.75rem 1rem; text-align:right; white-space:nowrap;">
                            <a href="{{ route('destinasi.show', $d->slug) }}" target="_blank" class="btn btn-outline" style="padding:0.35rem 0.65rem; font-size:0.75rem; margin-right:0.3rem;">Lihat</a>
                            <a href="{{ route('admin.destinasi.edit', $d) }}" class="btn btn-outline" style="padding:0.35rem 0.65rem; font-size:0.75rem; margin-right:0.3rem;">Edit</a>
                            <form method="POST" action="{{ route('admin.destinasi.destroy', $d) }}" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus destinasi {{ $d->nama }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" style="padding:0.35rem 0.65rem; font-size:0.75rem; color:#dc2626; border-color:#fca5a5;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding:2rem; text-align:center; color:var(--muted);">Tidak ada data destinasi yang cocok.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:1rem;">
        {{ $destinasi->links() }}
    </div>
</div>
@endsection
