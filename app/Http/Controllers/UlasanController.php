<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{

    /**
     * GET /ulasan — daftar semua ulasan pengunjung.
     */
    public function index()
    {
        return response()->json([
            'data' => Ulasan::orderBy('created_at', 'desc')->get(),
        ]);
    }

    /**
     * POST /ulasan — tambah ulasan pengunjung baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'destinasi_id' => 'required|integer|exists:destinasi,id',
            'nama_pengunjung' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string',
            'status' => 'in:pending,disetujui,ditolak',
        ]);

        $item = Ulasan::create($validated);

        return response()->json([
            'data' => $item,
            'message' => 'Data berhasil ditambahkan.',
        ], 201);
    }

    /**
     * GET /ulasan/{ulasan} — detail satu ulasan pengunjung.
     */
    public function show(Ulasan $ulasan)
    {
        return response()->json([
            'data' => $ulasan,
        ]);
    }

    /**
     * PUT/PATCH /ulasan/{ulasan} — ubah data ulasan pengunjung.
     */
    public function update(Request $request, Ulasan $ulasan)
    {
        $validated = $request->validate([
            'destinasi_id' => 'sometimes|integer|exists:destinasi,id',
            'nama_pengunjung' => 'sometimes|string|max:255',
            'rating' => 'sometimes|integer|min:1|max:5',
            'komentar' => 'nullable|string',
            'status' => 'in:pending,disetujui,ditolak',
        ]);

        $ulasan->update($validated);

        return response()->json([
            'data' => $ulasan->fresh(),
            'message' => 'Data berhasil diperbarui.',
        ]);
    }

    /**
     * DELETE /ulasan/{ulasan} — hapus ulasan pengunjung.
     */
    public function destroy(Ulasan $ulasan)
    {
        $ulasan->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus.',
        ]);
    }
}
