<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * Hanya pemilik bookmark atau admin yang boleh mengakses/mengubahnya.
     */
    private function autorisasiPemilik(Request $request, Bookmark $bookmark): void
    {
        $user = $request->user();
        if ($user->role !== 'admin' && $bookmark->user_id !== $user->id) {
            abort(403, 'Bukan bookmark Anda.');
        }
    }


    /**
     * GET /bookmark — semua bookmark (beserta destinasinya).
     */
    public function index(Request $request)
    {
        $query = Bookmark::with('destinasi')->orderByDesc('created_at');
        if ($request->user()->role !== 'admin') {
            $query->where('user_id', $request->user()->id);
        }

        return response()->json([
            'data' => $query->get(),
        ]);
    }

    /**
     * POST /bookmark — simpan destinasi ke favorit (idempoten).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'destinasi_id' => 'required|integer|exists:destinasi,id',
        ]);

        // Bookmark selalu milik user yang login
        $validated['user_id'] = $request->user()->id;

        $item = Bookmark::firstOrCreate($validated);

        return response()->json([
            'data' => $item->load('destinasi'),
            'message' => 'Destinasi disimpan ke favorit.',
        ], 201);
    }

    /**
     * GET /bookmark/{bookmark} — detail satu bookmark.
     */
    public function show(Request $request, Bookmark $bookmark)
    {
        $this->autorisasiPemilik($request, $bookmark);

        return response()->json([
            'data' => $bookmark->load('destinasi', 'user'),
        ]);
    }

    /**
     * PUT/PATCH /bookmark/{bookmark} — ubah referensi bookmark.
     */
    public function update(Request $request, Bookmark $bookmark)
    {
        $this->autorisasiPemilik($request, $bookmark);

        $validated = $request->validate([
            'destinasi_id' => 'sometimes|integer|exists:destinasi,id',
        ]);

        $bookmark->update($validated);

        return response()->json([
            'data' => $bookmark->fresh()->load('destinasi'),
            'message' => 'Bookmark berhasil diperbarui.',
        ]);
    }

    /**
     * DELETE /bookmark/{bookmark} — hapus bookmark.
     */
    public function destroy(Request $request, Bookmark $bookmark)
    {
        $this->autorisasiPemilik($request, $bookmark);

        $bookmark->delete();

        return response()->json([
            'message' => 'Bookmark berhasil dihapus.',
        ]);
    }
}
