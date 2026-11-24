<?php

namespace App\Http\Controllers;

use App\Models\Budaya;
use App\Models\Destinasi;
use App\Models\Kalender;
use App\Models\Wilayah;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $destinasiUnggulan = Destinasi::with('wilayah')
            ->where('status', 'aktif')
            ->orderByDesc('is_unggulan')
            ->orderByDesc('rating_awal')
            ->orderBy('nama')
            ->take(6)
            ->get();

        $budaya = Budaya::orderBy('judul')->take(3)->get();

        $hariIni = now()->startOfDay();
        $hariRaya = Kalender::whereNotNull('tanggal_iso')
            ->get()
            ->map(function (Kalender $k) use ($hariIni) {
                $tanggal = Carbon::parse($k->tanggal_iso)->startOfDay();

                return [
                    'nama' => $k->nama,
                    'tanggal' => $tanggal,
                    'selisih' => (int) $hariIni->diffInDays($tanggal, false),
                ];
            })
            ->sortBy('selisih')
            ->take(3)
            ->values();

        $totalDestinasi = Destinasi::where('status', 'aktif')->count();
        $totalWilayah = Wilayah::count();

        return view('home', compact(
            'destinasiUnggulan',
            'budaya',
            'hariRaya',
            'totalDestinasi',
            'totalWilayah',
        ));
    }
}
