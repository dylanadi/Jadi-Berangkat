<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function index()
    {
        $ulasan = Ulasan::latest()->paginate(10);
        return view('admin.ulasan.index', compact('ulasan'));
    }

    public function show(Ulasan $ulasan)
    {
        return redirect()->route('admin.ulasan.edit', $ulasan);
    }

    public function edit(Ulasan $ulasan)
    {
        $kategoris = \App\Models\Kategori::all();
        return view('admin.ulasan.edit', compact('ulasan', 'kategoris'));
    }

    public function update(Request $request, Ulasan $ulasan)
    {
        $validated = $request->validate([
            'nama_user' => 'required|string|max:50',
            'bintang' => 'required|integer|min:1|max:5',
            'pesan' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'image_id' => 'nullable|exists:images,id',
            'ditampilkan' => 'boolean',
        ]);

        $ulasan->update($validated);
        return redirect()->route('admin.ulasan.index')->with('success', 'Ulasan berhasil diupdate');
    }

    public function destroy(Ulasan $ulasan)
    {
        $ulasan->delete();
        return redirect()->route('admin.ulasan.index')->with('success', 'Ulasan berhasil dihapus');
    }
}
