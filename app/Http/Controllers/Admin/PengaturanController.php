<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HalamanStatis;
use App\Models\PengaturanHalamanDepan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturan = PengaturanHalamanDepan::pluck('value', 'key')->toArray();
        return view('admin.pengaturan.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $keys = [
            'hero_label', 'hero_judul', 'hero_deskripsi', 'hero_btn',
            'statistik_1', 'statistik_1_label', 'statistik_2', 'statistik_2_label',
            'statistik_3', 'statistik_3_label',
            'cta_judul', 'cta_deskripsi', 'copyright',
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                PengaturanHalamanDepan::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->$key, 'tipe' => 'text']
                );
            }
        }

        return redirect()->route('admin.pengaturan.index')->with('success', 'Pengaturan berhasil disimpan');
    }

    public function inlineUpdate(Request $request)
    {
        $request->validate([
            'field' => 'required|string',
            'value' => 'required|string',
        ]);

        PengaturanHalamanDepan::updateOrCreate(
            ['key' => $request->field],
            ['value' => $request->value, 'tipe' => 'text']
        );

        return response()->json(['success' => true]);
    }

    public function batchSave(Request $request)
    {
        $changes = $request->input('changes', []);
        $count = 0;

        if ($request->expectsJson()) {
            collect($changes)->each(function ($change) use (&$count) {
                $this->processChange($change, $count);
            });
            return response()->json(['success' => true, 'count' => $count]);
        }

        foreach ($changes as $change) {
            $this->processChange($change, $count);
        }

        return redirect()->back()->with('success', $count . ' perubahan tersimpan');
    }

    private function processChange($change, &$count)
    {
        $field = $change['field'] ?? null;
        $value = $change['value'] ?? null;
        $tipe = $change['tipe'] ?? '';

        if (!$field || $value === null) return;

        // If tipe is provided, save to halaman_statis
        if ($tipe) {
            $page = HalamanStatis::where('tipe', $tipe)->first();
            if ($page) {
                if (in_array($tipe, ['beranda', 'tentang', 'privasi'])) {
                    $data = json_decode($page->konten, true) ?: [];
                    // Handle _sections_count: truncate sections array
                    if ($field === '_sections_count') {
                        $countVal = (int) $value;
                        if (isset($data['sections'])) {
                            $data['sections'] = array_slice($data['sections'], 0, $countVal);
                        }
                        $page->update(['konten' => json_encode($data, JSON_UNESCAPED_UNICODE)]);
                        $count++;
                        return;
                    }
                    // Handle sections[INDEX].field format
                    if (preg_match('/^sections\[(\d+)\]\.(.+)$/', $field, $m)) {
                        $idx = (int) $m[1];
                        $key = $m[2];
                        if (!isset($data['sections'])) $data['sections'] = [];
                        while (count($data['sections']) <= $idx) {
                            $data['sections'][] = ['judul' => '', 'konten' => ''];
                        }
                        $data['sections'][$idx][$key] = $value;
                    } else {
                        $data[$field] = $value;
                    }
                    $page->update(['konten' => json_encode($data, JSON_UNESCAPED_UNICODE)]);
                    $count++;
                } elseif (in_array($field, ['judul', 'konten'])) {
                    $page->update([$field => $value]);
                    $count++;
                }
                return;
            }
        }

        // Fallback: save to pengaturan_halaman_depan
        PengaturanHalamanDepan::updateOrCreate(
            ['key' => $field],
            ['value' => $value, 'tipe' => 'text']
        );
        $count++;
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $path = $request->file('image')->store('uploads', 'public');
        $url = asset('storage/' . $path);

        $field = $request->input('field', '');
        if ($field) {
            $page = HalamanStatis::where('tipe', 'beranda')->orWhere('tipe', 'tentang')->first();
            if ($page) {
                $data = json_decode($page->konten, true) ?: [];
                $data[$field] = $path;
                $page->update(['konten' => json_encode($data, JSON_UNESCAPED_UNICODE)]);
            }
        }

        return response()->json(['success' => true, 'url' => $url, 'path' => $path]);
    }
}
