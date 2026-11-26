@extends('admin.layout', ['title' => 'Moderasi Ulasan', 'headerTitle' => 'Moderasi Ulasan Pengunjung'])

@section('admin-content')
<div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem; margin-bottom:1.5rem;">
    <!-- Filter Status -->
    <div style="display:flex; gap:0.4rem;">
        <a href="{{ route('admin.ulasan.index') }}" class="btn {{ empty($status) ? 'btn-primary' : 'btn-outline' }}" style="padding:0.45rem 0.9rem; font-size:0.8rem; border-radius:var(--r-full);">
            Semua
        </a>
        <a href="{{ route('admin.ulasan.index', ['status' => 'pending']) }}" class="btn {{ $status === 'pending' ? 'btn-primary' : 'btn-outline' }}" style="padding:0.45rem 0.9rem; font-size:0.8rem; border-radius:var(--r-full);">
            Pending
        </a>
        <a href="{{ route('admin.ulasan.index', ['status' => 'disetujui']) }}" class="btn {{ $status === 'disetujui' ? 'btn-primary' : 'btn-outline' }}" style="padding:0.45rem 0.9rem; font-size:0.8rem; border-radius:var(--r-full);">
            Disetujui
        </a>
        <a href="{{ route('admin.ulasan.index', ['status' => 'ditolak']) }}" class="btn {{ $status === 'ditolak' ? 'btn-primary' : 'btn-outline' }}" style="padding:0.45rem 0.9rem; font-size:0.8rem; border-radius:var(--r-full);">
            Ditolak
        </a>
    </div>
</div>

<div class="panel" style="overflow:hidden; padding:0;">
    <div style="overflow-x:auto;">
        <table class="table-admin" style="width:100%; border-collapse:collapse; text-align:left; font-size:0.875rem;">
            <thead>
                <tr style="background:var(--blue-soft); border-bottom:1.5px solid var(--line); color:var(--navy);">
                    <th style="padding:0.85rem 1rem;">Pengunjung &amp; Tanggal</th>
                    <th style="padding:0.85rem 1rem;">Destinasi &amp; Rating</th>
                    <th style="padding:0.85rem 1rem;">Isi Komentar</th>
                    <th style="padding:0.85rem 1rem;">Status</th>
                    <th style="padding:0.85rem 1rem; text-align:right;">Aksi Moderasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ulasan as $u)
                    <tr style="border-bottom:1px solid var(--line);">
                        <td style="padding:0.75rem 1rem; width:20%;">
                            <strong style="color:var(--navy); font-size:0.95rem; display:block;">{{ $u->nama_pengunjung }}</strong>
                            <span style="color:var(--muted); font-size:0.8rem;">
                                {{ $u->created_at?->locale('id')->translatedFormat('j M Y, H:i') }}
                            </span>
                        </td>
                        <td style="padding:0.75rem 1rem; width:22%;">
                            <strong style="color:var(--navy); font-size:0.9rem; display:block;">{{ $u->destinasi->nama ?? '—' }}</strong>
                            <span style="color:var(--terra); font-weight:700; font-size:0.85rem;">★ {{ $u->rating }}/5</span>
                        </td>
                        <td style="padding:0.75rem 1rem; color:var(--text); line-height:1.45;">
                            "{{ $u->komentar }}"
                        </td>
                        <td style="padding:0.75rem 1rem;">
                            <span class="badge-status {{ $u->status }}">{{ ucfirst($u->status) }}</span>
                        </td>
                        <td style="padding:0.75rem 1rem; text-align:right; white-space:nowrap;">
                            @if ($u->status !== 'disetujui')
                                <form method="POST" action="{{ route('admin.ulasan.status', $u) }}" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="disetujui">
                                    <button type="submit" class="btn btn-outline" style="padding:0.35rem 0.65rem; font-size:0.75rem; color:#059669; border-color:#a7f3d0; margin-right:0.25rem;">Setujui</button>
                                </form>
                            @endif

                            @if ($u->status !== 'ditolak')
                                <form method="POST" action="{{ route('admin.ulasan.status', $u) }}" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit" class="btn btn-outline" style="padding:0.35rem 0.65rem; font-size:0.75rem; color:#d97706; border-color:#fde68a; margin-right:0.25rem;">Tolak</button>
                                </form>
                            @endif

                            <form method="POST" action="{{ route('admin.ulasan.destroy', $u) }}" style="display:inline;" onsubmit="return confirm('Hapus ulasan ini secara permanen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" style="padding:0.35rem 0.65rem; font-size:0.75rem; color:#dc2626; border-color:#fca5a5;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding:2rem; text-align:center; color:var(--muted);">Tidak ada ulasan ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:1rem;">
        {{ $ulasan->links() }}
    </div>
</div>
@endsection
