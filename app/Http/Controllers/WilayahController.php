<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    /**
     * GET /wilayah — daftar semua wilayah (urut id).
     */
    public function index()
    {
        return response()->json([
            'data' => Wilayah::orderBy('id')->get(),
        ]);
    }

    /**
     * POST /wilayah — tambah wilayah baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|string|max:255|unique:wilayah,slug',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $wilayah = Wilayah::create($validated);

        return response()->json([
            'data' => $wilayah,
            'message' => 'Wilayah berhasil ditambahkan.',
        ], 201);
    }

    /**
     * GET /wilayah/{wilayah} — detail satu wilayah.
     */
    public function show(Wilayah $wilayah)
    {
        return response()->json([
            'data' => $wilayah,
        ]);
    }

    /**
     * PUT/PATCH /wilayah/{wilayah} — ubah sebagian data wilayah.
     */
    public function update(Request $request, Wilayah $wilayah)
    {
        $validated = $request->validate([
            'slug' => 'sometimes|string|max:255|unique:wilayah,slug,' . $wilayah->id,
            'nama' => 'sometimes|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $wilayah->update($validated);

        return response()->json([
            'data' => $wilayah->fresh(),
            'message' => 'Wilayah berhasil diperbarui.',
        ]);
    }

    /**
     * DELETE /wilayah/{wilayah} — hapus wilayah.
     */
    public function destroy(Wilayah $wilayah)
    {
        try {
            $wilayah->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'message' => 'Wilayah tidak dapat dihapus karena masih dipakai destinasi.',
            ], 422);
        }

        return response()->json([
            'message' => 'Wilayah berhasil dihapus.',
        ]);
    }
}
