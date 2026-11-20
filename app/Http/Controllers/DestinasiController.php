<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use Illuminate\Http\Request;

class DestinasiController extends Controller
{

    /**
     * GET /destinasi — daftar semua destinasi (beserta nama wilayah).
     */
    public function index()
    {
        return response()->json([
            'data' => Destinasi::with('wilayah')->orderByDesc('is_unggulan')->orderBy('id')->get(),
        ]);
    }

    /**
     * POST /destinasi — tambah destinasi baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|string|max:255|unique:destinasi,slug',
            'wilayah_id' => 'required|integer|exists:wilayah,id',
            'nama' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'waktu_terbaik' => 'nullable|string|max:255',
            'jam_buka' => 'nullable|string|max:255',
            'tarif' => 'nullable|string|max:255',
            'cara_masuk' => 'required|string',
            'etika' => 'required|string',
            'whatsapp' => 'nullable|string|max:30',
            'kontak' => 'nullable|string|max:255',
            'rating_awal' => 'numeric|min:0|max:5',
            'gambar' => 'nullable|string|max:255',
            'is_unggulan' => 'boolean',
            'status' => 'in:draft,aktif',
            'latitude' => 'numeric',
            'longitude' => 'numeric',
            'maps_url' => 'nullable|string|max:255',
            'user_id' => 'nullable|integer|exists:users,id',
        ]);

        $validated['rating_awal'] = $validated['rating_awal'] ?? 4.5;
        $validated['status'] = $validated['status'] ?? 'aktif';
        // Kontributor selalu dianggap pemilik; hanya admin yang boleh set/transfer user_id
        if ($request->user()->role !== 'admin') {
            $validated['user_id'] = $request->user()->id;
        } else {
            $validated['user_id'] = $validated['user_id'] ?? $request->user()->id;
        }

        $item = Destinasi::create($validated);

        return response()->json([
            'data' => $item->load('wilayah'),
            'message' => 'Destinasi berhasil ditambahkan.',
        ], 201);
    }

    /**
     * GET /destinasi/{destinasi} — detail lengkap destinasi.
     */
    public function show(Destinasi $destinasi)
    {
        return response()->json([
            'data' => $destinasi->load(['wilayah', 'detail', 'galeri', 'highlight', 'aktivitas', 'budaya']),
        ]);
    }

    /**
     * PUT/PATCH /destinasi/{destinasi} — ubah data destinasi.
     */
    public function update(Request $request, Destinasi $destinasi)
    {
        $validated = $request->validate([
            'slug' => 'sometimes|string|max:255|unique:destinasi,slug,' . $destinasi->id,
            'wilayah_id' => 'sometimes|integer|exists:wilayah,id',
            'nama' => 'sometimes|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'deskripsi' => 'sometimes|string',
            'waktu_terbaik' => 'nullable|string|max:255',
            'jam_buka' => 'nullable|string|max:255',
            'tarif' => 'nullable|string|max:255',
            'cara_masuk' => 'sometimes|string',
            'etika' => 'sometimes|string',
            'whatsapp' => 'nullable|string|max:30',
            'kontak' => 'nullable|string|max:255',
            'rating_awal' => 'numeric|min:0|max:5',
            'gambar' => 'nullable|string|max:255',
            'is_unggulan' => 'boolean',
            'status' => 'in:draft,aktif',
            'latitude' => 'numeric',
            'longitude' => 'numeric',
            'maps_url' => 'nullable|string|max:255',
            'user_id' => 'nullable|integer|exists:users,id',
        ]);

        if ($request->user()->role !== 'admin') {
            unset($validated['user_id']);   // kontributor tidak boleh transfer kepemilikan
        }
        $destinasi->update($validated);

        return response()->json([
            'data' => $destinasi->fresh()->load('wilayah'),
            'message' => 'Destinasi berhasil diperbarui.',
        ]);
    }

    /**
     * DELETE /destinasi/{destinasi} — hapus destinasi (anak ikut terhapus).
     */
    public function destroy(Destinasi $destinasi)
    {
        $destinasi->delete();

        return response()->json([
            'message' => 'Destinasi berhasil dihapus.',
        ]);
    }
}
