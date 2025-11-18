<?php

namespace App\Http\Controllers;

use App\Models\PotensiDesa;
use App\Models\GaleriFoto;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil beberapa potensi terbaru (misal 3)
        $potensis = PotensiDesa::latest()->take(3)->get();

        // Ambil beberapa foto galeri terbaru (misal 12)
        $galeriFotos = GaleriFoto::orderByDesc('tanggal')->take(12)->get();

        return view('home', compact('potensis', 'galeriFotos'));
    }
}
