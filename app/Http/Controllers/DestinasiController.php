<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\MediaSosial;

class DestinasiController extends Controller
{
    public function index()
    {
        $destinasi = Destinasi::with('image')->where('status', 'aktif')->paginate(12);
        
        // Fetch featured destinations (e.g., top 3 by rating or just 3 random/latest active ones)
        // Adjust ordering if there is a 'rating' column, otherwise sort by latest
        $featured_destinasi = Destinasi::with('image')->where('status', 'aktif')->orderByDesc('id')->take(3)->get();
        
        $mediaSosial = MediaSosial::where('aktif', true)->get();
        
        $halaman = \Illuminate\Support\Facades\DB::table('halaman_statis')->where('tipe', 'destinasi')->first();
        $data = $halaman ? json_decode($halaman->konten) : new \stdClass();
        
        // Handle hero image if it uses Media model or just a direct path
        // For simplicity, we just pass the object, and we can fetch image via helper if needed.
        $destinasiHero = null;
        if(isset($data->destinasi_hero_img) && is_numeric($data->destinasi_hero_img)) {
             $destinasiHero = \App\Models\Media::find($data->destinasi_hero_img);
        }
        
        // We will pass the 5 most recent destinations for the new slider
        $slider_destinasi = Destinasi::with('image')->where('status', 'aktif')->latest()->take(5)->get();
        
        return view('destinasi', compact('destinasi', 'featured_destinasi', 'mediaSosial', 'data', 'destinasiHero', 'slider_destinasi'));
    }

    public function show($slug)
    {
        $destinasi = Destinasi::with('image')->where('slug', $slug)->where('status', 'aktif')->firstOrFail();
        $destinasi->load(['jadwalPerjalanan', 'includes', 'unIncludes']);
        $lainnya = Destinasi::with('image')->where('status', 'aktif')->where('id', '!=', $destinasi->id)->take(4)->get();
        $mediaSosial = MediaSosial::where('aktif', true)->get();
        return view('detail', compact('destinasi', 'lainnya', 'mediaSosial'));
    }
}
