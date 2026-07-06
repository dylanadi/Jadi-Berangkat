<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\MediaSosial;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::latest()->get();
        $mediaSosial = MediaSosial::where('aktif', true)->get();
        return view('galeri', compact('galeri', 'mediaSosial'));
    }
}
