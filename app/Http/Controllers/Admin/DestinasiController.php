<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DestinasiController extends Controller
{
    public function index()
    {
        $destinasi = Destinasi::with('image')->latest()->paginate(10);
        return view('admin.destinasi.index', compact('destinasi'));
    }

    public function create()
    {
        $images = Image::latest()->get();
        $kategoriList = Destinasi::KATEGORI;
        $durasiList = Destinasi::DURASI;
        $moodList = Destinasi::MOOD;
        $kategoris = \App\Models\Kategori::all();
        return view('admin.destinasi.create', compact('images', 'kategoriList', 'durasiList', 'moodList', 'kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'harga' => 'nullable|numeric',
            'image_id' => 'nullable|exists:images,id',
            'status' => 'required|string|in:aktif,nonaktif',
            'durasi' => 'nullable|string|max:50',
            'mood' => 'nullable|string|max:50',
            'rating' => 'nullable|string|max:10',
        ]);

        $validated['slug'] = Str::slug($validated['nama']);
        
        // Ensure slug is unique
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Destinasi::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        Destinasi::create($validated);
        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil ditambahkan');
    }

    public function edit(Destinasi $destinasi)
    {
        $images = Image::latest()->get();
        $kategoriList = Destinasi::KATEGORI;
        $durasiList = Destinasi::DURASI;
        $moodList = Destinasi::MOOD;
        $kategoris = \App\Models\Kategori::all();
        return view('admin.destinasi.edit', compact('destinasi', 'images', 'kategoriList', 'durasiList', 'moodList', 'kategoris'));
    }

    public function update(Request $request, Destinasi $destinasi)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'harga' => 'nullable|numeric',
            'image_id' => 'nullable|exists:images,id',
            'status' => 'required|string|in:aktif,nonaktif',
            'durasi' => 'nullable|string|max:50',
            'mood' => 'nullable|string|max:50',
            'rating' => 'nullable|string|max:10',
        ]);

        $validated['slug'] = Str::slug($validated['nama']);
        
        // Ensure slug is unique
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Destinasi::where('slug', $validated['slug'])->where('id', '!=', $destinasi->id)->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        $destinasi->update($validated);
        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil diupdate');
    }

    public function destroy(Destinasi $destinasi)
    {
        $destinasi->delete();
        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil dihapus');
    }
}
