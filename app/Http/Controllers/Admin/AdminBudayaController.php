<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Budaya;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminBudayaController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $query = Budaya::latest();

        if ($q !== '') {
            $query->where('judul', 'like', "%{$q}%")
                ->orWhere('ringkas', 'like', "%{$q}%");
        }

        $budaya = $query->paginate(15)->withQueryString();
        return view('admin.budaya.index', compact('budaya', 'q'));
    }

    public function create()
    {
        return view('admin.budaya.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:budaya,slug'],
            'ringkas' => ['required', 'string'],
            'detail' => ['required', 'string'],
        ]);

        $slug = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['judul']);
        $originalSlug = $slug;
        $counter = 1;
        while (Budaya::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }
        $validated['slug'] = $slug;

        Budaya::create($validated);

        return redirect()->route('admin.budaya.index')->with('success', 'Panduan etika budaya berhasil ditambahkan!');
    }

    public function edit(Budaya $budaya)
    {
        return view('admin.budaya.edit', compact('budaya'));
    }

    public function update(Request $request, Budaya $budaya)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:budaya,slug,' . $budaya->id],
            'ringkas' => ['required', 'string'],
            'detail' => ['required', 'string'],
        ]);

        $validated['slug'] = Str::slug($validated['slug']);
        $budaya->update($validated);

        return redirect()->route('admin.budaya.index')->with('success', 'Panduan etika budaya berhasil diperbarui!');
    }

    public function destroy(Budaya $budaya)
    {
        $judul = $budaya->judul;
        $budaya->delete();

        return redirect()->route('admin.budaya.index')->with('success', "Etika \"{$judul}\" berhasil dihapus!");
    }
}
