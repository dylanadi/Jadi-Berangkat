<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\Artikel;
use App\Models\Ulasan;
use App\Models\Galeri;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDestinasi = Destinasi::count();
        $totalArtikel = Artikel::count();
        $totalUlasan = Ulasan::count();
        $totalGaleri = Galeri::count();
        $destinasiTerbaru = Destinasi::latest()->take(5)->get();
        $artikelTerbaru = Artikel::latest()->take(5)->get();
        return view('admin.dashboard', compact(
            'totalDestinasi', 'totalArtikel', 'totalUlasan', 'totalGaleri',
            'destinasiTerbaru', 'artikelTerbaru'
        ));
    }
}
