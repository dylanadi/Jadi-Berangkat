<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_user' => 'required|string|max:50',
            'bintang' => 'required|integer|min:1|max:5',
            'pesan' => 'required|string',
            'kategori' => 'nullable|string|max:20',
        ]);

        $ulasan = Ulasan::create($validated);
        return back()->with('success', 'Terima kasih atas ulasan Anda!');
    }
}
