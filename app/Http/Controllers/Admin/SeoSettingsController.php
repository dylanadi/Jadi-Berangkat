<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSettings;
use Illuminate\Http\Request;

class SeoSettingsController extends Controller
{
    public function index()
    {
        $settings = SeoSettings::pluck('value', 'key')->toArray();
        return view('admin.seo.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $fields = [
            'meta_title', 'meta_description', 'meta_keywords',
            'favicon', 'logo', 'og_image',
        ];

        foreach ($fields as $key) {
            if ($request->has($key)) {
                SeoSettings::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->$key, 'tipe' => in_array($key, ['favicon', 'logo', 'og_image']) ? 'file' : 'text']
                );
            }
        }

        if ($request->hasFile('favicon')) {
            $path = $request->file('favicon')->store('seo', 'public');
            SeoSettings::updateOrCreate(['key' => 'favicon'], ['value' => $path, 'tipe' => 'file']);
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('seo', 'public');
            SeoSettings::updateOrCreate(['key' => 'logo'], ['value' => $path, 'tipe' => 'file']);
        }

        if ($request->hasFile('og_image')) {
            $path = $request->file('og_image')->store('seo', 'public');
            SeoSettings::updateOrCreate(['key' => 'og_image'], ['value' => $path, 'tipe' => 'file']);
        }

        return redirect()->route('admin.seo.index')->with('success', 'SEO settings berhasil disimpan');
    }
}
