<?php

namespace App\Http\Controllers;

use App\Models\DestinasiDetail;
use Illuminate\Http\Request;

class DestinasiDetailController extends Controller
{

    /**
     * GET /destinasi-detail — daftar semua paragraf detail.
     */
    public function index()
    {
        return response()->json([
            'data' => DestinasiDetail::orderBy('destinasi_id')->orderBy('urutan')->get(),
        ]);
    }

    /**
     * POST /destinasi-detail — tambah paragraf detail baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'destinasi_id' => 'required|integer|exists:destinasi,id',
            'urutan' => 'integer|min:0',
            'paragraf' => 'required|string',
        ]);

        $item = DestinasiDetail::create($validated);

        return response()->json([
            'data' => $item,
            'message' => 'Data berhasil ditambahkan.',
        ], 201);
    }

    /**
     * GET /destinasi-detail/{destinasi_detail} — detail satu paragraf detail.
     */
    public function show(DestinasiDetail $destinasi_detail)
    {
        return response()->json([
            'data' => $destinasi_detail,
        ]);
    }

    /**
     * PUT/PATCH /destinasi-detail/{destinasi_detail} — ubah data paragraf detail.
     */
    public function update(Request $request, DestinasiDetail $destinasi_detail)
    {
        $validated = $request->validate([
            'destinasi_id' => 'sometimes|integer|exists:destinasi,id',
            'urutan' => 'integer|min:0',
            'paragraf' => 'sometimes|string',
        ]);

        $destinasi_detail->update($validated);

        return response()->json([
            'data' => $destinasi_detail->fresh(),
            'message' => 'Data berhasil diperbarui.',
        ]);
    }

    /**
     * DELETE /destinasi-detail/{destinasi_detail} — hapus paragraf detail.
     */
    public function destroy(DestinasiDetail $destinasi_detail)
    {
        $destinasi_detail->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus.',
        ]);
    }
}
