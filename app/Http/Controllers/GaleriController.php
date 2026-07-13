<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\MediaSosial;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::with('image')->latest()->get();
        $mediaSosial = MediaSosial::where('aktif', true)->get();
        $semuaKategori = \App\Models\Kategori::all();
        return view('galeri', compact('galeri', 'mediaSosial', 'semuaKategori'));
    }
}
