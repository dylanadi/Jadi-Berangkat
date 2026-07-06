<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\MediaSosial;

class DestinasiController extends Controller
{
    public function index()
    {
        $destinasi = Destinasi::where('status', 'aktif')->paginate(12);
        $mediaSosial = MediaSosial::where('aktif', true)->get();
        return view('destinasi', compact('destinasi', 'mediaSosial'));
    }

    public function show($slug)
    {
        $destinasi = Destinasi::where('slug', $slug)->where('status', 'aktif')->firstOrFail();
        $destinasi->load(['jadwalPerjalanan', 'includes', 'unIncludes']);
        $lainnya = Destinasi::where('status', 'aktif')->where('id', '!=', $destinasi->id)->take(4)->get();
        $mediaSosial = MediaSosial::where('aktif', true)->get();
        return view('detail', compact('destinasi', 'lainnya', 'mediaSosial'));
    }
}
