<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kalender;
use Illuminate\Http\Request;

class AdminKalenderController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $query = Kalender::orderBy('tanggal_iso');

        if ($q !== '') {
            $query->where('nama', 'like', "%{$q}%")
                ->orWhere('keterangan', 'like', "%{$q}%");
        }

        $kalender = $query->paginate(15)->withQueryString();
        return view('admin.kalender.index', compact('kalender', 'q'));
    }

    public function create()
    {
        return view('admin.kalender.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'tanggal_teks' => ['required', 'string', 'max:100'],
            'tanggal_iso' => ['required', 'date'],
            'keterangan' => ['required', 'string'],
            'saran' => ['nullable', 'string'],
            'sejarah' => ['nullable', 'string'],
        ]);

        $validated['saran'] = $validated['saran'] ?? '';
        $validated['sejarah'] = $validated['sejarah'] ?? '';

        Kalender::create($validated);

        return redirect()->route('admin.kalender.index')->with('success', 'Agenda ritual kalender berhasil ditambahkan!');
    }

    public function edit(Kalender $kalender)
    {
        return view('admin.kalender.edit', compact('kalender'));
    }

    public function update(Request $request, Kalender $kalender)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'tanggal_teks' => ['required', 'string', 'max:100'],
            'tanggal_iso' => ['required', 'date'],
            'keterangan' => ['required', 'string'],
            'saran' => ['nullable', 'string'],
            'sejarah' => ['nullable', 'string'],
        ]);

        $kalender->update($validated);

        return redirect()->route('admin.kalender.index')->with('success', 'Agenda ritual kalender berhasil diperbarui!');
    }

    public function destroy(Kalender $kalender)
    {
        $nama = $kalender->nama;
        $kalender->delete();

        return redirect()->route('admin.kalender.index')->with('success', "Agenda \"{$nama}\" berhasil dihapus!");
    }
}
