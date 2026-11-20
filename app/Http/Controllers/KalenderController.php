<?php

namespace App\Http\Controllers;

use App\Models\Kalender;
use Illuminate\Http\Request;

class KalenderController extends Controller
{

    /**
     * GET /kalender — daftar semua hari suci.
     */
    public function index()
    {
        return response()->json([
            'data' => Kalender::orderBy('id')->get(),
        ]);
    }

    /**
     * POST /kalender — tambah hari suci baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_teks' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'saran' => 'nullable|string',
            'sejarah' => 'nullable|string',
        ]);

        $item = Kalender::create($validated);

        return response()->json([
            'data' => $item,
            'message' => 'Data berhasil ditambahkan.',
        ], 201);
    }

    /**
     * GET /kalender/{kalender} — detail satu hari suci.
     */
    public function show(Kalender $kalender)
    {
        return response()->json([
            'data' => $kalender,
        ]);
    }

    /**
     * PUT/PATCH /kalender/{kalender} — ubah data hari suci.
     */
    public function update(Request $request, Kalender $kalender)
    {
        $validated = $request->validate([
            'nama' => 'sometimes|string|max:255',
            'tanggal_teks' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'saran' => 'nullable|string',
            'sejarah' => 'nullable|string',
        ]);

        $kalender->update($validated);

        return response()->json([
            'data' => $kalender->fresh(),
            'message' => 'Data berhasil diperbarui.',
        ]);
    }

    /**
     * DELETE /kalender/{kalender} — hapus hari suci.
     */
    public function destroy(Kalender $kalender)
    {
        $kalender->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus.',
        ]);
    }
}
