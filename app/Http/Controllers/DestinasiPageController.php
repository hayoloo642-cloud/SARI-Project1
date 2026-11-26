<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DestinasiPageController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $wilayahSlug = (string) $request->query('wilayah', 'semua');

        $query = Destinasi::with('wilayah')->where('status', 'aktif');

        if ($wilayahSlug !== '' && $wilayahSlug !== 'semua') {
            $query->whereHas('wilayah', fn ($w) => $w->where('slug', $wilayahSlug));
        }

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('nama', 'like', "%{$q}%")
                    ->orWhere('deskripsi', 'like', "%{$q}%")
                    ->orWhere('kategori', 'like', "%{$q}%")
                    ->orWhere('etika', 'like', "%{$q}%")
                    ->orWhere('pengelola_nama', 'like', "%{$q}%")
                    ->orWhereHas('wilayah', fn ($w) => $w->where('nama', 'like', "%{$q}%"));
            });
        }

        // Hitung data peta sebelum paginate: paginate() menambahkan limit/offset
        // ke builder aslinya, sehingga clone setelahnya ikut terpotong.
        $petaDestinasi = (clone $query)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderBy('nama')
            ->get(['id', 'slug', 'nama', 'kategori', 'latitude', 'longitude'])
            ->map(fn (Destinasi $d) => [
                'slug' => $d->slug,
                'nama' => $d->nama,
                'kategori' => $d->kategori,
                'lat' => (float) $d->latitude,
                'lng' => (float) $d->longitude,
            ])
            ->values();

        $destinasi = $query
            ->orderByDesc('is_unggulan')
            ->orderBy('nama')
            ->paginate(9)
            ->withQueryString();

        $wilayah = Wilayah::orderBy('nama')->get();

        return view('destinasi.index', compact('destinasi', 'wilayah', 'petaDestinasi', 'q', 'wilayahSlug'));
    }

    public function show(Destinasi $destinasi)
    {
        abort_unless($destinasi->status === 'aktif', 404);

        $destinasi->load(['wilayah', 'detail', 'galeri', 'highlight', 'aktivitas', 'budaya']);

        $ulasan = $destinasi->ulasan()
            ->where('status', 'disetujui')
            ->latest()
            ->get();

        $rating = $ulasan->isNotEmpty()
            ? round((float) $ulasan->avg('rating'), 1)
            : (float) $destinasi->rating_awal;

        return view('destinasi.show', compact('destinasi', 'ulasan', 'rating'));
    }

    public function wilayah(Wilayah $wilayah)
    {
        return redirect()->route('destinasi.index', ['wilayah' => $wilayah->slug]);
    }
}
