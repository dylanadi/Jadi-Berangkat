<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::latest()->paginate(10);
        return view('admin.artikel.index', compact('artikel'));
    }

    public function create()
    {
        $kategoris = \App\Models\Kategori::all();
        return view('admin.artikel.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:artikel',
            'konten' => 'required|string',
            'image_id' => 'nullable|exists:images,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'penulis' => 'nullable|string|max:100',
            'durasi_baca' => 'nullable|integer',
            'status' => 'required|string|in:draft,terbit',
            'tanggal_terbit' => 'nullable|date',
        ]);



        Artikel::create($validated);
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function edit(Artikel $artikel)
    {
        $kategoris = \App\Models\Kategori::all();
        return view('admin.artikel.edit', compact('artikel', 'kategoris'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:artikel,slug,' . $artikel->id,
            'konten' => 'required|string',
            'image_id' => 'nullable|exists:images,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'penulis' => 'nullable|string|max:100',
            'durasi_baca' => 'nullable|integer',
            'status' => 'required|string|in:draft,terbit',
            'tanggal_terbit' => 'nullable|date',
        ]);



        $artikel->update($validated);
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diupdate');
    }

    public function destroy(Artikel $artikel)
    {
        $artikel->delete();
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus');
    }
}
