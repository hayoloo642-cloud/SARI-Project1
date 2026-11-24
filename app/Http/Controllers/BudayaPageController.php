<?php

namespace App\Http\Controllers;

use App\Models\Budaya;

class BudayaPageController extends Controller
{
    public function index()
    {
        $budaya = Budaya::orderBy('judul')->get();

        return view('budaya.index', compact('budaya'));
    }

    public function show(Budaya $budaya)
    {
        $budaya->load(['destinasi.wilayah']);

        return view('budaya.show', compact('budaya'));
    }
}
