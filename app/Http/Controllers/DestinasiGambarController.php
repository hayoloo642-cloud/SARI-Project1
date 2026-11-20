<?php

namespace App\Http\Controllers;

use App\Models\DestinasiGambar;
use Illuminate\Http\Request;

class DestinasiGambarController extends Controller
{

    /**
     * GET /destinasi-gambar — daftar semua foto destinasi.
     */
    public function index()
    {
        return response()->json([
            'data' => DestinasiGambar::orderBy('destinasi_id')->orderByDesc('is_utama')->get(),
        ]);
    }

    /**
     * POST /destinasi-gambar — tambah foto destinasi baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'destinasi_id' => 'required|integer|exists:destinasi,id',
            'path' => 'required|string|max:255',
            'alt' => 'nullable|string|max:255',
            'is_utama' => 'boolean',
            'kredit' => 'nullable|string|max:255',
            'sumber_url' => 'nullable|string|max:255',
        ]);

        $item = DestinasiGambar::create($validated);

        return response()->json([
            'data' => $item,
            'message' => 'Data berhasil ditambahkan.',
        ], 201);
    }

    /**
     * GET /destinasi-gambar/{destinasi_gambar} — detail satu foto destinasi.
     */
    public function show(DestinasiGambar $destinasi_gambar)
    {
        return response()->json([
            'data' => $destinasi_gambar,
        ]);
    }

    /**
     * PUT/PATCH /destinasi-gambar/{destinasi_gambar} — ubah data foto destinasi.
     */
    public function update(Request $request, DestinasiGambar $destinasi_gambar)
    {
        $validated = $request->validate([
            'destinasi_id' => 'sometimes|integer|exists:destinasi,id',
            'path' => 'sometimes|string|max:255',
            'alt' => 'nullable|string|max:255',
            'is_utama' => 'boolean',
            'kredit' => 'nullable|string|max:255',
            'sumber_url' => 'nullable|string|max:255',
        ]);

        $destinasi_gambar->update($validated);

        return response()->json([
            'data' => $destinasi_gambar->fresh(),
            'message' => 'Data berhasil diperbarui.',
        ]);
    }

    /**
     * DELETE /destinasi-gambar/{destinasi_gambar} — hapus foto destinasi.
     */
    public function destroy(DestinasiGambar $destinasi_gambar)
    {
        $destinasi_gambar->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus.',
        ]);
    }
}
