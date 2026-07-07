<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Image;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::with('image')->latest()->paginate(10);
        return view('admin.artikel.index', compact('artikel'));
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'         => 'required|string|max:255',
            'slug'          => 'required|string|max:255|unique:artikel',
            'konten'        => 'required|string',
            'gambar'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'kategori'      => 'nullable|string|max:50',
            'penulis'       => 'nullable|string|max:100',
            'durasi_baca'   => 'nullable|integer',
            'status'        => 'required|string|in:draft,terbit',
            'tanggal_terbit' => 'nullable|date',
        ]);

        // Upload gambar dan simpan ke tabel images terpusat
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('artikel', 'public');
            $image = Image::create([
                'name' => $validated['judul'],
                'path' => $path,   // contoh: artikel/abc123.jpg
                'alt'  => $validated['judul'],
                'disk' => 'public',
            ]);
            $validated['image_id'] = $image->id;
            $validated['gambar'] = $path;
        }

        Artikel::create($validated);
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function edit(Artikel $artikel)
    {
        $artikel->load('image');
        return view('admin.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $validated = $request->validate([
            'judul'         => 'required|string|max:255',
            'slug'          => 'required|string|max:255|unique:artikel,slug,' . $artikel->id,
            'konten'        => 'required|string',
            'gambar'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'kategori'      => 'nullable|string|max:50',
            'penulis'       => 'nullable|string|max:100',
            'durasi_baca'   => 'nullable|integer',
            'status'        => 'required|string|in:draft,terbit',
            'tanggal_terbit' => 'nullable|date',
        ]);

        // Upload gambar baru dan simpan ke tabel images terpusat
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('artikel', 'public');
            $image = Image::create([
                'name' => $validated['judul'],
                'path' => $path,
                'alt'  => $validated['judul'],
                'disk' => 'public',
            ]);
            $validated['image_id'] = $image->id;
            $validated['gambar'] = $path;
        } else {
            unset($validated['gambar']);
        }

        $artikel->update($validated);
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diupdate');
    }

    public function destroy(Artikel $artikel)
    {
        $artikel->delete();
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus');
    }
}
