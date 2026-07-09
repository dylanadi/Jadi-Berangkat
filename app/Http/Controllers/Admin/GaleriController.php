<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::latest()->paginate(10);
        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        $kategoris = \App\Models\Kategori::all();
        return view('admin.galeri.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'image_id' => 'required|exists:images,id',
            'deskripsi' => 'nullable|string',
            'slug' => 'nullable|string|max:255',
        ]);



        Galeri::create($validated);
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan');
    }

    public function edit(Galeri $galeri)
    {
        $kategoris = \App\Models\Kategori::all();
        return view('admin.galeri.edit', compact('galeri', 'kategoris'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'image_id' => 'nullable|exists:images,id',
            'deskripsi' => 'nullable|string',
            'slug' => 'nullable|string|max:255',
        ]);



        $galeri->update($validated);
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diupdate');
    }

    public function destroy(Galeri $galeri)
    {
        $galeri->delete();
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus');
    }
}
