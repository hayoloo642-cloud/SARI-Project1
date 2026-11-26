@extends('admin.layout', ['title' => 'Etika Budaya', 'headerTitle' => 'Kelola Panduan Etika Budaya'])

@section('admin-content')
<div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem; margin-bottom:1.5rem;">
    <form method="GET" action="{{ route('admin.budaya.index') }}" style="display:flex; gap:0.5rem; align-items:center;">
        <input type="text" name="q" value="{{ $q }}" placeholder="Cari judul etika..." style="padding:0.55rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.875rem; min-width:240px;">
        <button type="submit" class="btn btn-outline" style="padding:0.55rem 1rem; font-size:0.875rem;">Cari</button>
        @if ($q)
            <a href="{{ route('admin.budaya.index') }}" class="btn btn-ghost" style="padding:0.55rem 0.75rem; font-size:0.875rem;">Reset</a>
        @endif
    </form>

    <a href="{{ route('admin.budaya.create') }}" class="btn btn-primary" style="padding:0.6rem 1.25rem; font-size:0.9rem;">
        + Tambah Panduan Etika
    </a>
</div>

<div class="panel" style="overflow:hidden; padding:0;">
    <div style="overflow-x:auto;">
        <table class="table-admin" style="width:100%; border-collapse:collapse; text-align:left; font-size:0.875rem;">
            <thead>
                <tr style="background:var(--blue-soft); border-bottom:1.5px solid var(--line); color:var(--navy);">
                    <th style="padding:0.85rem 1rem;">Judul Panduan</th>
                    <th style="padding:0.85rem 1rem;">Ringkasan</th>
                    <th style="padding:0.85rem 1rem; text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($budaya as $b)
                    <tr style="border-bottom:1px solid var(--line);">
                        <td style="padding:0.75rem 1rem; width:30%;">
                            <strong style="color:var(--navy); font-size:0.95rem; display:block;">{{ $b->judul }}</strong>
                            <span style="color:var(--muted); font-size:0.8rem;"><code>/etika/{{ $b->slug }}</code></span>
                        </td>
                        <td style="padding:0.75rem 1rem; color:var(--text); line-height:1.45;">
                            {{ Str::limit($b->ringkas, 140) }}
                        </td>
                        <td style="padding:0.75rem 1rem; text-align:right; white-space:nowrap;">
                            <a href="{{ route('etika.show', $b->slug) }}" target="_blank" class="btn btn-outline" style="padding:0.35rem 0.65rem; font-size:0.75rem; margin-right:0.3rem;">Lihat</a>
                            <a href="{{ route('admin.budaya.edit', $b) }}" class="btn btn-outline" style="padding:0.35rem 0.65rem; font-size:0.75rem; margin-right:0.3rem;">Edit</a>
                            <form method="POST" action="{{ route('admin.budaya.destroy', $b) }}" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus etika {{ $b->judul }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" style="padding:0.35rem 0.65rem; font-size:0.75rem; color:#dc2626; border-color:#fca5a5;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="padding:2rem; text-align:center; color:var(--muted);">Belum ada data panduan etika.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:1rem;">
        {{ $budaya->links() }}
    </div>
</div>
@endsection
