@extends('admin.layout', ['title' => 'Kalender Agama', 'headerTitle' => 'Kelola Agenda Kalender Agama & Ritual'])

@section('admin-content')
<div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem; margin-bottom:1.5rem;">
    <form method="GET" action="{{ route('admin.kalender.index') }}" style="display:flex; gap:0.5rem; align-items:center;">
        <input type="text" name="q" value="{{ $q }}" placeholder="Cari nama upacara..." style="padding:0.55rem 0.9rem; border:1.5px solid var(--line); border-radius:var(--r-md); font-size:0.875rem; min-width:240px;">
        <button type="submit" class="btn btn-outline" style="padding:0.55rem 1rem; font-size:0.875rem;">Cari</button>
        @if ($q)
            <a href="{{ route('admin.kalender.index') }}" class="btn btn-ghost" style="padding:0.55rem 0.75rem; font-size:0.875rem;">Reset</a>
        @endif
    </form>

    <a href="{{ route('admin.kalender.create') }}" class="btn btn-primary" style="padding:0.6rem 1.25rem; font-size:0.9rem;">
        + Tambah Agenda Ritual
    </a>
</div>

<div class="panel" style="overflow:hidden; padding:0;">
    <div style="overflow-x:auto;">
        <table class="table-admin" style="width:100%; border-collapse:collapse; text-align:left; font-size:0.875rem;">
            <thead>
                <tr style="background:var(--blue-soft); border-bottom:1.5px solid var(--line); color:var(--navy);">
                    <th style="padding:0.85rem 1rem;">Tanggal &amp; ISO</th>
                    <th style="padding:0.85rem 1rem;">Nama Upacara / Hari Suci</th>
                    <th style="padding:0.85rem 1rem;">Keterangan &amp; Saran Wisatawan</th>
                    <th style="padding:0.85rem 1rem; text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kalender as $k)
                    <tr style="border-bottom:1px solid var(--line);">
                        <td style="padding:0.75rem 1rem; width:22%; white-space:nowrap;">
                            <strong style="color:var(--navy); font-size:0.95rem; display:block;">{{ $k->tanggal_teks }}</strong>
                            <span style="color:var(--muted); font-size:0.8rem;">ISO: {{ $k->tanggal_iso }}</span>
                        </td>
                        <td style="padding:0.75rem 1rem; width:25%;">
                            <strong style="color:var(--terra); font-size:0.95rem;">{{ $k->nama }}</strong>
                        </td>
                        <td style="padding:0.75rem 1rem; color:var(--text); line-height:1.45;">
                            <div>{{ Str::limit($k->keterangan, 120) }}</div>
                            @if ($k->saran)
                                <div style="font-size:0.8rem; color:var(--muted); margin-top:0.25rem;">Saran: {{ Str::limit($k->saran, 80) }}</div>
                            @endif
                        </td>
                        <td style="padding:0.75rem 1rem; text-align:right; white-space:nowrap;">
                            <a href="{{ route('admin.kalender.edit', $k) }}" class="btn btn-outline" style="padding:0.35rem 0.65rem; font-size:0.75rem; margin-right:0.3rem;">Edit</a>
                            <form method="POST" action="{{ route('admin.kalender.destroy', $k) }}" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus agenda {{ $k->nama }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" style="padding:0.35rem 0.65rem; font-size:0.75rem; color:#dc2626; border-color:#fca5a5;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding:2rem; text-align:center; color:var(--muted);">Belum ada jadwal ritual kalender.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:1rem;">
        {{ $kalender->links() }}
    </div>
</div>
@endsection
