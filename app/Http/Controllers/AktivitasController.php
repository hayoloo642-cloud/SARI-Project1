<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    /**
     * GET /aktivitas — daftar semua aktivitas (urut id).
     */
    public function index()
    {
        return response()->json([
            'data' => Aktivitas::orderBy('id')->get(),
        ]);
    }

    /**
     * POST /aktivitas — tambah aktivitas baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:aktivitas,nama',
        ]);

        $aktivitas = Aktivitas::create($validated);

        return response()->json([
            'data' => $aktivitas,
            'message' => 'Aktivitas berhasil ditambahkan.',
        ], 201);
    }

    /**
     * GET /aktivitas/{aktivitas} — detail satu aktivitas.
     */
    public function show(Aktivitas $aktivitas)
    {
        return response()->json([
            'data' => $aktivitas,
        ]);
    }

    /**
     * PUT/PATCH /aktivitas/{aktivitas} — ubah nama aktivitas.
     */
    public function update(Request $request, Aktivitas $aktivitas)
    {
        $validated = $request->validate([
            'nama' => 'sometimes|string|max:255|unique:aktivitas,nama,' . $aktivitas->id,
        ]);

        $aktivitas->update($validated);

        return response()->json([
            'data' => $aktivitas->fresh(),
            'message' => 'Aktivitas berhasil diperbarui.',
        ]);
    }

    /**
     * DELETE /aktivitas/{aktivitas} — hapus aktivitas.
     */
    public function destroy(Aktivitas $aktivitas)
    {
        $aktivitas->delete();

        return response()->json([
            'message' => 'Aktivitas berhasil dihapus.',
        ]);
    }
}
