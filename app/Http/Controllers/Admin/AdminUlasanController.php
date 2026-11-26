<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class AdminUlasanController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $query = Ulasan::with('destinasi')->latest();

        if ($status && in_array($status, ['pending', 'disetujui', 'ditolak'])) {
            $query->where('status', $status);
        }

        $ulasan = $query->paginate(20)->withQueryString();
        return view('admin.ulasan.index', compact('ulasan', 'status'));
    }

    public function updateStatus(Request $request, Ulasan $ulasan)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,disetujui,ditolak'],
        ]);

        $ulasan->update($validated);

        return back()->with('success', "Status ulasan berhasil diubah menjadi {$validated['status']}.");
    }

    public function destroy(Ulasan $ulasan)
    {
        $ulasan->delete();
        return back()->with('success', 'Ulasan berhasil dihapus.');
    }
}
