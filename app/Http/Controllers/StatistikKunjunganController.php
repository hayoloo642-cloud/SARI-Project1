<?php

namespace App\Http\Controllers;

use App\Models\StatistikKunjungan;
use Illuminate\Http\Request;

class StatistikKunjunganController extends Controller
{

    /**
     * GET /statistik-kunjungan — daftar kunjungan (urut tanggal terbaru).
     */
    public function index()
    {
        return response()->json([
            'data' => StatistikKunjungan::orderByDesc('tanggal')->get(),
        ]);
    }

    /**
     * POST /statistik-kunjungan — catat kunjungan (upsert per destinasi+tanggal).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'destinasi_id' => 'required|integer|exists:destinasi,id',
            'tanggal' => 'required|date',
            'jumlah' => 'integer|min:1',
        ]);

        $item = StatistikKunjungan::updateOrCreate(
            ['destinasi_id' => $validated['destinasi_id'], 'tanggal' => $validated['tanggal']],
            ['jumlah' => ($validated['jumlah'] ?? 1) + (StatistikKunjungan::where([
                'destinasi_id' => $validated['destinasi_id'],
                'tanggal' => $validated['tanggal'],
            ])->value('jumlah') ?? 0)]
        );

        return response()->json([
            'data' => $item,
            'message' => 'Kunjungan tercatat.',
        ], 201);
    }

    /**
     * GET /statistik-kunjungan/{statistik_kunjungan} — detail satu baris.
     */
    public function show(StatistikKunjungan $statistik_kunjungan)
    {
        return response()->json([
            'data' => $statistik_kunjungan,
        ]);
    }

    /**
     * PUT/PATCH /statistik-kunjungan/{statistik_kunjungan} — ubah data kunjungan.
     */
    public function update(Request $request, StatistikKunjungan $statistik_kunjungan)
    {
        $validated = $request->validate([
            'destinasi_id' => 'sometimes|integer|exists:destinasi,id',
            'tanggal' => 'sometimes|date',
            'jumlah' => 'integer|min:0',
        ]);

        $statistik_kunjungan->update($validated);

        return response()->json([
            'data' => $statistik_kunjungan->fresh(),
            'message' => 'Data berhasil diperbarui.',
        ]);
    }

    /**
     * DELETE /statistik-kunjungan/{statistik_kunjungan} — hapus baris statistik.
     */
    public function destroy(StatistikKunjungan $statistik_kunjungan)
    {
        $statistik_kunjungan->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus.',
        ]);
    }
}
