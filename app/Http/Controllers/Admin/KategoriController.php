<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::latest()->get();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'icon' => $request->icon ?? 'bi bi-tag',
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'icon' => $request->icon ?? $kategori->icon,
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        $isUsed = \App\Models\Destinasi::where('kategori_id', $kategori->id)->exists()
               || \App\Models\Artikel::where('kategori_id', $kategori->id)->exists()
               || \App\Models\Galeri::where('kategori_id', $kategori->id)->exists()
               || \App\Models\Ulasan::where('kategori_id', $kategori->id)->exists();

        if ($isUsed) {
            return redirect()->back()->with('error', 'Kamu tidak bisa menghapus kategori ini, karena banyak konten menggunakan kategori ini.');
        }

        $kategori->delete();
        return redirect()->back()->with('success_popup', 'Kategori berhasil dihapus.');
    }
}
