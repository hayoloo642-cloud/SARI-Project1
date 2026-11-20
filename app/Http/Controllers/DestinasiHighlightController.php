<?php

namespace App\Http\Controllers;

use App\Models\DestinasiHighlight;
use Illuminate\Http\Request;

class DestinasiHighlightController extends Controller
{

    /**
     * GET /destinasi-highlight — daftar semua sorotan destinasi.
     */
    public function index()
    {
        return response()->json([
            'data' => DestinasiHighlight::orderBy('destinasi_id')->orderBy('urutan')->get(),
        ]);
    }

    /**
     * POST /destinasi-highlight — tambah sorotan destinasi baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'destinasi_id' => 'required|integer|exists:destinasi,id',
            'urutan' => 'integer|min:0',
            'teks' => 'required|string',
        ]);

        $item = DestinasiHighlight::create($validated);

        return response()->json([
            'data' => $item,
            'message' => 'Data berhasil ditambahkan.',
        ], 201);
    }

    /**
     * GET /destinasi-highlight/{destinasi_highlight} — detail satu sorotan destinasi.
     */
    public function show(DestinasiHighlight $destinasi_highlight)
    {
        return response()->json([
            'data' => $destinasi_highlight,
        ]);
    }

    /**
     * PUT/PATCH /destinasi-highlight/{destinasi_highlight} — ubah data sorotan destinasi.
     */
    public function update(Request $request, DestinasiHighlight $destinasi_highlight)
    {
        $validated = $request->validate([
            'destinasi_id' => 'sometimes|integer|exists:destinasi,id',
            'urutan' => 'integer|min:0',
            'teks' => 'sometimes|string',
        ]);

        $destinasi_highlight->update($validated);

        return response()->json([
            'data' => $destinasi_highlight->fresh(),
            'message' => 'Data berhasil diperbarui.',
        ]);
    }

    /**
     * DELETE /destinasi-highlight/{destinasi_highlight} — hapus sorotan destinasi.
     */
    public function destroy(DestinasiHighlight $destinasi_highlight)
    {
        $destinasi_highlight->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus.',
        ]);
    }
}
