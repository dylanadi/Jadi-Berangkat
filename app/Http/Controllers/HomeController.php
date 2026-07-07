<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Ulasan;
use App\Models\Galeri;
use App\Models\Artikel;
use App\Models\MediaSosial;
use App\Models\PengaturanHalamanDepan;
use App\Models\HalamanStatis;

class HomeController extends Controller
{
    public function index()
    {
        $destinasi = Destinasi::where('status', 'aktif')->with('image')->take(6)->get();
        $paket = $destinasi;
        $armada = Destinasi::where('status', 'aktif')->with('image')->take(4)->get();
        $ulasan = Ulasan::where('ditampilkan', true)->get();
        $galeri = Galeri::with('image')->take(8)->get();
        $artikel = Artikel::where('status', 'terbit')->with('image')->latest()->take(3)->get();
        $mediaSosial = MediaSosial::where('aktif', true)->get();
        $page = HalamanStatis::where('tipe', 'beranda')->first();
        $pengaturan = (object) ($page ? json_decode($page->konten, true) : []);
        return view('home', compact('destinasi', 'paket', 'armada', 'ulasan', 'galeri', 'artikel', 'mediaSosial', 'pengaturan', 'page'));
    }

    public function tentang()
    {
        $page = HalamanStatis::where('tipe', 'tentang')->first();
        $data = (object) ($page ? json_decode($page->konten, true) : []);
        $halaman = $page;
        $mediaSosial = MediaSosial::where('aktif', true)->get();
        return view('tentang', compact('data', 'halaman', 'mediaSosial'));
    }

    public function privasi()
    {
        $page = HalamanStatis::where('tipe', 'privasi')->first();
        $data = (object) ($page ? json_decode($page->konten, true) : []);
        $halaman = $page;
        $sections = $data->sections ?? [];
        return view('privasi', compact('data', 'halaman', 'sections'));
    }

    public function bantuan()
    {
        $halaman = HalamanStatis::where('tipe', 'bantuan')->first();
        return view('bantuan', compact('halaman'));
    }
}
