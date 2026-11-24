<?php

namespace App\Http\Controllers;

use App\Models\Kalender;
use Illuminate\Support\Carbon;

class KalenderPageController extends Controller
{
    public function index()
    {
        $hariIni = now()->startOfDay();

        $kalender = Kalender::orderByRaw('tanggal_iso IS NULL, tanggal_iso')
            ->get()
            ->map(function (Kalender $k) use ($hariIni) {
                $tanggal = $k->tanggal_iso ? Carbon::parse($k->tanggal_iso)->startOfDay() : null;

                return [
                    'item' => $k,
                    'selisih' => $tanggal ? (int) $hariIni->diffInDays($tanggal, false) : null,
                ];
            });

        return view('kalender.index', compact('kalender'));
    }
}
