<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\Ulasan;
use App\Models\User;
use App\Models\Wilayah;
use App\Models\Budaya;
use App\Models\Kalender;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'totalDestinasi' => Destinasi::count(),
            'totalUlasanPending' => Ulasan::where('status', 'pending')->count(),
            'totalBudaya' => Budaya::count(),
            'totalKalender' => Kalender::count(),
            'totalKontributor' => User::where('role', 'kontributor')->count(),
            'ulasanTerbaru' => Ulasan::with('destinasi')->latest()->take(6)->get(),
            'destinasiTerbaru' => Destinasi::with('wilayah')->latest()->take(5)->get(),
        ]);
    }
}
