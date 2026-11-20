<?php

namespace App\Http\Controllers;

use App\Models\Budaya;
use Illuminate\Http\Request;

class BudayaController extends Controller
{

    /**
     * GET /budaya — daftar semua topik budaya.
     */
    public function index()
    {
        return response()->json([
            'data' => Budaya::orderBy('id')->get(),
        ]);
    }

    /**
     * POST /budaya — tambah topik budaya baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|string|max:255|unique:budaya,slug',
            'judul' => 'required|string|max:255',
            'ringkas' => 'nullable|string',
            'detail' => 'nullable|string',
        ]);

        $item = Budaya::create($validated);

        return response()->json([
            'data' => $item,
            'message' => 'Data berhasil ditambahkan.',
        ], 201);
    }

    /**
     * GET /budaya/{budaya} — detail satu topik budaya.
     */
    public function show(Budaya $budaya)
    {
        return response()->json([
            'data' => $budaya,
        ]);
    }

    /**
     * PUT/PATCH /budaya/{budaya} — ubah data topik budaya.
     */
    public function update(Request $request, Budaya $budaya)
    {
        $validated = $request->validate([
            'slug' => 'sometimes|string|max:255|unique:budaya,slug,' . $budaya->id,
            'judul' => 'sometimes|string|max:255',
            'ringkas' => 'nullable|string',
            'detail' => 'nullable|string',
        ]);

        $budaya->update($validated);

        return response()->json([
            'data' => $budaya->fresh(),
            'message' => 'Data berhasil diperbarui.',
        ]);
    }

    /**
     * DELETE /budaya/{budaya} — hapus topik budaya.
     */
    public function destroy(Budaya $budaya)
    {
        $budaya->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus.',
        ]);
    }
}
