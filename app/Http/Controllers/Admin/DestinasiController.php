<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\JadwalPerjalanan;
use App\Models\IncludeModel;
use App\Models\UnInclude;
use Illuminate\Http\Request;

class DestinasiController extends Controller
{
    public function index()
    {
        $destinasi = Destinasi::latest()->paginate(10);
        return view('admin.destinasi.index', compact('destinasi'));
    }

    public function create()
    {
        return view('admin.destinasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|string',
            'nama' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:destinasi',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'harga' => 'nullable|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|string|in:aktif,nonaktif',
            'durasi' => 'nullable|string|max:50',
            'mood' => 'nullable|string|max:50',
            'rating' => 'nullable|string|max:10',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('destinasi', 'public');
        }

        Destinasi::create($validated);
        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil ditambahkan');
    }

    public function edit(Destinasi $destinasi)
    {
        return view('admin.destinasi.edit', compact('destinasi'));
    }

    public function update(Request $request, Destinasi $destinasi)
    {
        $validated = $request->validate([
            'kategori' => 'required|string',
            'nama' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:destinasi,slug,' . $destinasi->id,
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'harga' => 'nullable|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|string|in:aktif,nonaktif',
            'durasi' => 'nullable|string|max:50',
            'mood' => 'nullable|string|max:50',
            'rating' => 'nullable|string|max:10',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('destinasi', 'public');
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
