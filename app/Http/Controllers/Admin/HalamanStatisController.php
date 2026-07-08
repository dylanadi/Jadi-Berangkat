<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HalamanStatis;
use Illuminate\Http\Request;

class HalamanStatisController extends Controller
{
    public function index()
    {
        $halaman = HalamanStatis::all();
        return view('admin.halaman.index', compact('halaman'));
    }

    public function edit(HalamanStatis $halamanStatis)
    {
        return view('admin.halaman.edit', compact('halamanStatis'));
    }

    public function update(Request $request, HalamanStatis $halamanStatis)
    {
        if ($request->wantsJson() || $request->ajax()) {
            $request->validate([
                'field' => 'required|string|in:judul,konten',
                'value' => 'required|string',
            ]);
            $halamanStatis->update([$request->field => $request->value]);
            return response()->json(['success' => true]);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
        ]);

        $halamanStatis->update($validated);
        return redirect()->route('admin.halaman.index')->with('success', 'Halaman berhasil diupdate');
    }
}
