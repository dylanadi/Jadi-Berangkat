<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\MediaSosial;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::where('status', 'terbit')->with('image')->latest()->paginate(9);
        $mediaSosial = MediaSosial::where('aktif', true)->get();
        return view('artikel', compact('artikel', 'mediaSosial'));
    }

    public function show($slug)
    {
        $artikel = Artikel::where('slug', $slug)->where('status', 'terbit')
            ->with('image')->firstOrFail();
        $lainnya = Artikel::where('status', 'terbit')->where('id', '!=', $artikel->id)
            ->with('image')->take(4)->get();
        $mediaSosial = MediaSosial::where('aktif', true)->get();
        return view('artikel_view', compact('artikel', 'lainnya', 'mediaSosial'));
    }
}
