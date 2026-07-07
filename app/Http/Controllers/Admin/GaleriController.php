<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\Image;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::with('image')->latest()->paginate(10);
        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori'  => 'required|string',
            'judul'     => 'required|string|max:255',
            'gambar'    => 'required|image|mimes:jpeg,png,jpg,webp|max:4096',
            'deskripsi' => 'nullable|string',
            'slug'      => 'nullable|string|max:255',
        ]);

        // Upload gambar dan simpan ke tabel images terpusat
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('galeri', 'public');
            $image = Image::create([
                'name' => $validated['judul'],
                'path' => $path,   // contoh: galeri/abc123.jpg
                'alt'  => $validated['judul'],
                'disk' => 'public',
            ]);
            $validated['image_id'] = $image->id;
            // Simpan juga di kolom gambar sebagai fallback
            $validated['gambar'] = $path;
        }

        Galeri::create($validated);
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan');
    }

    public function edit(Galeri $galeri)
    {
        $galeri->load('image');
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'kategori'  => 'required|string',
            'judul'     => 'required|string|max:255',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'deskripsi' => 'nullable|string',
            'slug'      => 'nullable|string|max:255',
        ]);

        // Upload gambar baru dan simpan ke tabel images terpusat
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('galeri', 'public');
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

        $galeri->update($validated);
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diupdate');
    }

    public function destroy(Galeri $galeri)
    {
        $galeri->delete();
        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus');
    }
}
