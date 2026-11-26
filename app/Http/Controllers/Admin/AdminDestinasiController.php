<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminDestinasiController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $wilayahId = $request->query('wilayah_id');

        $query = Destinasi::with('wilayah')->latest();

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('nama', 'like', "%{$q}%")
                    ->orWhere('kategori', 'like', "%{$q}%")
                    ->orWhere('slug', 'like', "%{$q}%");
            });
        }

        if ($wilayahId) {
            $query->where('wilayah_id', $wilayahId);
        }

        $destinasi = $query->paginate(15)->withQueryString();
        $wilayah = Wilayah::orderBy('nama')->get();

        return view('admin.destinasi.index', compact('destinasi', 'wilayah', 'q', 'wilayahId'));
    }

    public function create()
    {
        $wilayah = Wilayah::orderBy('nama')->get();
        return view('admin.destinasi.create', compact('wilayah'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:destinasi,slug'],
            'wilayah_id' => ['required', 'exists:wilayah,id'],
            'kategori' => ['required', 'string', 'max:100'],
            'deskripsi' => ['required', 'string'],
            'waktu_terbaik' => ['nullable', 'string', 'max:150'],
            'jam_buka' => ['nullable', 'string', 'max:100'],
            'tarif' => ['nullable', 'string', 'max:150'],
            'cara_masuk' => ['nullable', 'string'],
            'etika' => ['nullable', 'string'],
            'status' => ['required', 'in:aktif,draft,nonaktif'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'whatsapp' => ['nullable', 'string', 'max:50'],
            'kontak' => ['nullable', 'string', 'max:100'],
            'pengelola_nama' => ['nullable', 'string', 'max:150'],
            'gambar' => ['nullable', 'image', 'max:4096'],
            'gambar_url' => ['nullable', 'string', 'max:255'],
            'gambar_kredit' => ['nullable', 'string', 'max:255'],
            'gambar_sumber' => ['nullable', 'string', 'max:255'],
            'is_unggulan' => ['nullable', 'boolean'],
        ]);

        $slug = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['nama']);
        $originalSlug = $slug;
        $counter = 1;
        while (Destinasi::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = $slug . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/destinasi'), $filename);
            $validated['gambar'] = 'assets/images/destinasi/' . $filename;
        } elseif (!empty($validated['gambar_url'])) {
            $validated['gambar'] = $validated['gambar_url'];
        } else {
            $validated['gambar'] = '';
        }
        unset($validated['gambar_url']);

        $validated['is_unggulan'] = $request->boolean('is_unggulan') ? 1 : 0;
        $lat = $validated['latitude'] ?? null;
        $lng = $validated['longitude'] ?? null;
        $validated['maps_url'] = ($lat && $lng) 
            ? "https://maps.google.com/?q={$lat},{$lng}"
            : '';
        $validated['user_id'] = auth()->id();

        $validated['cara_masuk'] = $validated['cara_masuk'] ?? '';
        $validated['etika'] = $validated['etika'] ?? '';
        $validated['jam_buka'] = $validated['jam_buka'] ?? '';
        $validated['tarif'] = $validated['tarif'] ?? '';
        $validated['waktu_terbaik'] = $validated['waktu_terbaik'] ?? '';
        $validated['pengelola_nama'] = $validated['pengelola_nama'] ?? '';
        $validated['whatsapp'] = $validated['whatsapp'] ?? '';
        $validated['kontak'] = $validated['kontak'] ?? '';
        $validated['latitude'] = $lat ?? 0.0;
        $validated['longitude'] = $lng ?? 0.0;

        Destinasi::create($validated);

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi wisata berhasil ditambahkan!');
    }

    public function edit(Destinasi $destinasi)
    {
        $wilayah = Wilayah::orderBy('nama')->get();
        return view('admin.destinasi.edit', compact('destinasi', 'wilayah'));
    }

    public function update(Request $request, Destinasi $destinasi)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:destinasi,slug,' . $destinasi->id],
            'wilayah_id' => ['required', 'exists:wilayah,id'],
            'kategori' => ['required', 'string', 'max:100'],
            'deskripsi' => ['required', 'string'],
            'waktu_terbaik' => ['nullable', 'string', 'max:150'],
            'jam_buka' => ['nullable', 'string', 'max:100'],
            'tarif' => ['nullable', 'string', 'max:150'],
            'cara_masuk' => ['nullable', 'string'],
            'etika' => ['nullable', 'string'],
            'status' => ['required', 'in:aktif,draft,nonaktif'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'whatsapp' => ['nullable', 'string', 'max:50'],
            'kontak' => ['nullable', 'string', 'max:100'],
            'pengelola_nama' => ['nullable', 'string', 'max:150'],
            'gambar' => ['nullable', 'image', 'max:4096'],
            'gambar_url' => ['nullable', 'string', 'max:255'],
            'gambar_kredit' => ['nullable', 'string', 'max:255'],
            'gambar_sumber' => ['nullable', 'string', 'max:255'],
            'is_unggulan' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['slug']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = $validated['slug'] . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/destinasi'), $filename);
            $validated['gambar'] = 'assets/images/destinasi/' . $filename;
        } elseif (!empty($validated['gambar_url'])) {
            $validated['gambar'] = $validated['gambar_url'];
        }
        unset($validated['gambar_url']);

        $validated['is_unggulan'] = $request->boolean('is_unggulan') ? 1 : 0;
        if (!empty($validated['latitude']) && !empty($validated['longitude'])) {
            $validated['maps_url'] = "https://maps.google.com/?q={$validated['latitude']},{$validated['longitude']}";
        }

        $lat = $validated['latitude'] ?? null;
        $lng = $validated['longitude'] ?? null;
        $validated['cara_masuk'] = $validated['cara_masuk'] ?? '';
        $validated['etika'] = $validated['etika'] ?? '';
        $validated['jam_buka'] = $validated['jam_buka'] ?? '';
        $validated['tarif'] = $validated['tarif'] ?? '';
        $validated['waktu_terbaik'] = $validated['waktu_terbaik'] ?? '';
        $validated['pengelola_nama'] = $validated['pengelola_nama'] ?? '';
        $validated['whatsapp'] = $validated['whatsapp'] ?? '';
        $validated['kontak'] = $validated['kontak'] ?? '';
        $validated['latitude'] = $lat ?? 0.0;
        $validated['longitude'] = $lng ?? 0.0;

        $destinasi->update($validated);

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi wisata berhasil diperbarui!');
    }

    public function destroy(Destinasi $destinasi)
    {
        $nama = $destinasi->nama;
        $destinasi->delete();

        return redirect()->route('admin.destinasi.index')->with('success', "Destinasi \"{$nama}\" berhasil dihapus!");
    }
}
