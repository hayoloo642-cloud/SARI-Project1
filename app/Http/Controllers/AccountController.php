<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Halaman akun pengunjung: profil ringkas + destinasi favorit.
     */
    public function index(Request $request)
    {
        $bookmarks = Bookmark::with(['destinasi.wilayah'])
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get()
            ->filter(fn (Bookmark $b) => $b->destinasi !== null)
            ->values();

        return view('akun', compact('bookmarks'));
    }
}
