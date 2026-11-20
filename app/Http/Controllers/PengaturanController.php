<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{

    /**
     * GET /pengaturan — semua konfigurasi.
     */
    public function index()
    {
        return response()->json([
            'data' => Pengaturan::all(),
        ]);
    }

    /**
     * POST /pengaturan — tambah konfigurasi baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255|unique:pengaturan,key',
            'value' => 'nullable|string',
        ]);

        $item = Pengaturan::create($validated);

        return response()->json([
            'data' => $item,
            'message' => 'Pengaturan berhasil ditambahkan.',
        ], 201);
    }

    /**
     * GET /pengaturan/{pengaturan} — satu konfigurasi (kunci string).
     */
    public function show(Pengaturan $pengaturan)
    {
        return response()->json([
            'data' => $pengaturan,
        ]);
    }

    /**
     * PUT/PATCH /pengaturan/{pengaturan} — ubah nilai konfigurasi.
     */
    public function update(Request $request, Pengaturan $pengaturan)
    {
        $validated = $request->validate([
            'value' => 'nullable|string',
        ]);

        $pengaturan->update($validated);

        return response()->json([
            'data' => $pengaturan->fresh(),
            'message' => 'Pengaturan berhasil diperbarui.',
        ]);
    }

    /**
     * DELETE /pengaturan/{pengaturan} — hapus konfigurasi.
     */
    public function destroy(Pengaturan $pengaturan)
    {
        $pengaturan->delete();

        return response()->json([
            'message' => 'Pengaturan berhasil dihapus.',
        ]);
    }
}
