<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaSosial;
use Illuminate\Http\Request;

class MediaSosialController extends Controller
{
    public function index()
    {
        $mediaSosial = MediaSosial::latest()->get();
        return view('admin.media-sosial.index', compact('mediaSosial'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:100',
            'link' => 'required|string|max:255',
            'ikon' => 'nullable|string|max:50',
            'aktif' => 'boolean',
        ]);

        MediaSosial::create($validated);
        return redirect()->route('admin.media-sosial.index')->with('success', 'Media sosial berhasil ditambahkan');
    }

    public function edit(MediaSosial $mediaSosial)
    {
        return view('admin.media-sosial.edit', compact('mediaSosial'));
    }

    public function update(Request $request, MediaSosial $mediaSosial)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:100',
            'link' => 'required|string|max:255',
            'ikon' => 'nullable|string|max:50',
            'aktif' => 'boolean',
        ]);

        $mediaSosial->update($validated);
        return redirect()->route('admin.media-sosial.index')->with('success', 'Media sosial berhasil diupdate');
    }

    public function destroy(MediaSosial $mediaSosial)
    {
        $mediaSosial->delete();
        return redirect()->route('admin.media-sosial.index')->with('success', 'Media sosial berhasil dihapus');
    }
}
