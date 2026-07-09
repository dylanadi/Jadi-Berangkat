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
        if (MediaSosial::count() >= 6) {
            return redirect()->back()->with('error', 'Maksimal 6 media sosial yang diizinkan');
        }

        $validated = $request->validate([
            'platform' => 'required|string|max:100',
            'link' => 'required|string|max:255',
            'nomor' => 'nullable|string|max:30',
            'ikon' => 'nullable|string|max:50',
            'aktif' => 'boolean',
        ]);

        $validated['aktif'] = $request->has('aktif');

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
            'nomor' => 'nullable|string|max:30',
            'ikon' => 'nullable|string|max:50',
            'aktif' => 'boolean',
        ]);

        if (strtolower($mediaSosial->platform) === 'whatsapp' && strtolower($validated['platform']) !== 'whatsapp') {
            return redirect()->back()->with('error', 'Nama platform WhatsApp tidak boleh diubah.');
        }

        $validated['aktif'] = $request->has('aktif');

        $mediaSosial->update($validated);
        return redirect()->route('admin.media-sosial.index')->with('success', 'Media sosial berhasil diupdate');
    }

    public function destroy(MediaSosial $mediaSosial)
    {
        if (strtolower($mediaSosial->platform) === 'whatsapp') {
            return redirect()->route('admin.media-sosial.index')->with('error', 'Platform WhatsApp tidak boleh dihapus.');
        }
        $mediaSosial->delete();
        return redirect()->route('admin.media-sosial.index')->with('success', 'Media sosial berhasil dihapus');
    }
}
