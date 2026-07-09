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
                $val = $request->$key;
                if (in_array($key, ['favicon', 'logo', 'og_image']) && is_numeric($val)) {
                    $val = \App\Models\Image::resolvePath($val);
                }
                
                if ($val !== null && $val !== '') {
                    SeoSettings::updateOrCreate(
                        ['key' => $key],
                        ['value' => $val, 'tipe' => in_array($key, ['favicon', 'logo', 'og_image']) ? 'file' : 'text']
                    );
                } elseif (in_array($key, ['favicon', 'logo', 'og_image']) && $val === '') {
                    // Jika dikosongkan (dihapus via component), kita bisa handle penghapusan atau biarkan.
                    // Jika dihapus, hapus dari database.
                    SeoSettings::where('key', $key)->delete();
                }
            }
        }

        return redirect()->route('admin.seo.index')->with('success', 'SEO settings berhasil disimpan');
    }
}
