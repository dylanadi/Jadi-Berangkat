<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HalamanStatis;
use App\Models\PengaturanHalamanDepan;
use App\Models\SectHomeHero;
use App\Models\SectHomePenawaran;
use App\Models\SectHomeCta;
use App\Models\SectHomeFooter;
use App\Models\SectAboutHero;
use App\Models\SectKisah;
use App\Models\SectVisimisi;
use App\Models\SectNilai;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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

        $field = $request->field;
        $value = $request->value;
        $tipe = $request->tipe ?? '';
        $imageId = $request->image_id;

        $imageFields = ['tentang_hero_img', 'tentang_kisah_img_1', 'tentang_kisah_img_2', 'tentang_galeri_img_1', 'tentang_galeri_img_2', 'tentang_galeri_img_3', 'tentang_galeri_img_4', 'tentang_galeri_img_5'];
        if (!$imageId && in_array($field, $imageFields) && $value) {
            $image = Image::firstOrCreate(
                ['path' => $value],
                ['name' => pathinfo($value, PATHINFO_FILENAME), 'disk' => 'local']
            );
            $imageId = $image->id;
        }

        if ($tipe === 'tentang') {
            $page = HalamanStatis::where('tipe', 'tentang')->first();
            if ($page) {
                $data = json_decode($page->konten, true) ?: [];
                $data[$field] = $imageId ? (int) $imageId : $value;
                $page->update(['konten' => json_encode($data, JSON_UNESCAPED_UNICODE)]);
            }
            $this->syncAboutSection($field, $value, $imageId);
        } elseif ($tipe === 'beranda') {
            $page = HalamanStatis::where('tipe', 'beranda')->first();
            if ($page) {
                $data = json_decode($page->konten, true) ?: [];
                $data[$field] = $value;
                $page->update(['konten' => json_encode($data, JSON_UNESCAPED_UNICODE)]);
            }
            $this->syncHomeSection($field, $value);
        } elseif ($tipe === 'galeri' && preg_match('/^galeri_img_(\d+)$/', $field, $m) && $imageId) {
            $galeri = \App\Models\Galeri::find((int) $m[1]);
            if ($galeri) {
                $galeri->update(['image_id' => (int) $imageId]);
            }
        } else {
            PengaturanHalamanDepan::updateOrCreate(
                ['key' => $field],
                ['value' => $value, 'tipe' => 'text']
            );
        }

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

        // Sync to new section tables for 'beranda' tipe
        if ($tipe === 'beranda') {
            $this->syncHomeSection($field, $value);
        }

        // Sync to new section tables for 'tentang' tipe
        if ($tipe === 'tentang') {
            $this->syncAboutSection($field, $value);
        }

        // If tipe is provided, save to halaman_statis (existing behavior)
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

    private function syncHomeSection($field, $value)
    {
        $heroMapping = [
            'hero_badge' => 'badge',
            'hero_judul' => 'judul',
            'hero_deskripsi' => 'deskripsi',
            'button_booking' => 'btn_booking',
            'button_destinasi' => 'btn_destinasi',
            'hero_jumlah_destinasi' => 'stat_destinasi_angka',
            'stat_hero_destinasi_label' => 'stat_destinasi_label',
            'hero_jumlah_armada' => 'stat_armada_angka',
            'stat_armada_label' => 'stat_armada_label',
            'hero_rating' => 'stat_rating_angka',
            'stat_rating_label' => 'stat_rating_label',
        ];

        $penawaranMapping = [
            'eyebrow_paket' => 'eyebrow',
            'paket_judul' => 'judul',
            'paket_deskripsi' => 'deskripsi',
        ];

        $ctaMapping = [
            'cta_judul' => 'judul',
            'cta_deskripsi' => 'deskripsi',
        ];

        $footerMapping = [
            'footer_judul' => 'judul',
            'footer_tentang' => 'tentang',
            'footer_copyright' => 'copyright',
        ];

        if (isset($heroMapping[$field])) {
            SectHomeHero::firstOrCreate([])->update([$heroMapping[$field] => $value]);
        } elseif (isset($penawaranMapping[$field])) {
            SectHomePenawaran::firstOrCreate([])->update([$penawaranMapping[$field] => $value]);
        } elseif (isset($ctaMapping[$field])) {
            SectHomeCta::firstOrCreate([])->update([$ctaMapping[$field] => $value]);
        } elseif (isset($footerMapping[$field])) {
            SectHomeFooter::firstOrCreate([])->update([$footerMapping[$field] => $value]);
        }
    }

    private function syncAboutSection($field, $value, $imageId = null)
    {
        $heroMapping = [
            'tentang_badge' => 'badge',
            'judul' => 'judul',
            'konten' => 'konten',
            'tentang_stat_tahun_angka' => 'stat_1_angka',
            'tentang_stat_tahun_label' => 'stat_1_label',
            'tentang_stat_wisatawan_angka' => 'stat_2_angka',
            'tentang_stat_wisatawan_label' => 'stat_2_label',
            'tentang_stat_rute_angka' => 'stat_3_angka',
            'tentang_stat_rute_label' => 'stat_3_label',
            'tentang_stat_armada_angka' => 'stat_4_angka',
            'tentang_stat_armada_label' => 'stat_4_label',
            'tentang_badge_premium' => 'badge_premium',
            'tentang_caption' => 'caption',
        ];

        $kisahMapping = [
            'tentang_kisah_badge' => 'badge',
            'tentang_kisah_judul' => 'judul',
            'tentang_kisah_p1' => 'deskripsi_1',
            'tentang_kisah_p2' => 'deskripsi_2',
            'tentang_kisah_p3' => 'highlight_text',
        ];

        $visimisiMapping = [
            'tentang_visimisi_badge' => 'badge',
            'tentang_visimisi_judul' => 'judul',
            'tentang_visi_text' => 'visi_deskripsi',
        ];

        $nilaiMapping = [
            'tentang_nilai_badge' => 'badge',
            'tentang_nilai_judul' => 'judul',
        ];

        if (isset($heroMapping[$field])) {
            SectAboutHero::firstOrCreate([])->update([$heroMapping[$field] => $value]);
        } elseif (isset($kisahMapping[$field])) {
            SectKisah::firstOrCreate([])->update([$kisahMapping[$field] => $value]);
        } elseif (isset($visimisiMapping[$field])) {
            SectVisimisi::firstOrCreate([])->update([$visimisiMapping[$field] => $value]);
        } elseif (isset($nilaiMapping[$field])) {
            SectNilai::firstOrCreate([])->update([$nilaiMapping[$field] => $value]);
        } elseif ($field === 'tentang_hero_img' && $imageId) {
            SectAboutHero::firstOrCreate([])->update(['gambar_id' => (int) $imageId]);
        } elseif ($field === 'tentang_kisah_img_1' && $imageId) {
            SectKisah::firstOrCreate([])->update(['gambar_1_id' => (int) $imageId]);
        } elseif ($field === 'tentang_kisah_img_2' && $imageId) {
            SectKisah::firstOrCreate([])->update(['gambar_2_id' => (int) $imageId]);
        } elseif (preg_match('/^tentang_galeri_img_(\d+)$/', $field, $m) && $imageId) {
            $galeri = SectGaleriAbout::first();
            if ($galeri) {
                $urutan = (int) $m[1];
                $tagDefault = "GALERI $urutan";
                if ($urutan == 1) $tagDefault = "EKSPEDISI IJEN";
                if ($urutan == 2) $tagDefault = "MOMEN SAVANA";
                
                $item = $galeri->items()->where('urutan', $urutan)->first();
                if ($item) {
                    $item->update(['gambar_id' => (int) $imageId]);
                } else {
                    $galeri->items()->create([
                        'urutan' => $urutan,
                        'gambar_id' => (int) $imageId,
                        'tag' => $tagDefault
                    ]);
                }
            }
        } elseif (preg_match('/^tentang_nilai_item_(\d+)_judul$/', $field, $m)) {
            $nilai = SectNilai::first();
            if ($nilai) {
                $card = $nilai->cardNilai()->where('urutan', (int) $m[1])->first();
                if ($card) $card->update(['judul' => $value]);
            }
        } elseif (preg_match('/^tentang_nilai_item_(\d+)_desc$/', $field, $m)) {
            $nilai = SectNilai::first();
            if ($nilai) {
                $card = $nilai->cardNilai()->where('urutan', (int) $m[1])->first();
                if ($card) $card->update(['deskripsi' => $value]);
            }
        } elseif (preg_match('/^tentang_misi_item_(\d+)$/', $field, $m)) {
            $visimisi = SectVisimisi::first();
            if ($visimisi) {
                $item = $visimisi->misiItems()->where('nomor', str_pad($m[1], 2, '0', STR_PAD_LEFT))->first();
                if ($item) $item->update(['deskripsi' => $value]);
            }
        }
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $path = $request->file('image')->store('uploads', 'public');
        $url = asset('storage/' . $path);

        $image = Image::create([
            'name' => pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME),
            'path' => $path,
            'alt' => pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME),
            'disk' => 'public',
        ]);

        $field = $request->input('field', '');
        if ($field) {
            $page = HalamanStatis::where('tipe', 'beranda')->orWhere('tipe', 'tentang')->first();
            if ($page) {
                $data = json_decode($page->konten, true) ?: [];
                $data[$field] = $image->id;
                $page->update(['konten' => json_encode($data, JSON_UNESCAPED_UNICODE)]);
            }
            $tipe = $request->input('tipe', '');
            if ($tipe === 'tentang') {
                $this->syncAboutSection($field, $image->id, $image->id);
            } elseif ($tipe === 'beranda') {
                $this->syncHomeSection($field, $image->id);
            } elseif ($tipe === 'galeri' && preg_match('/^galeri_img_(\d+)$/', $field, $m)) {
                $galeri = \App\Models\Galeri::find((int) $m[1]);
                if ($galeri) {
                    $galeri->update(['image_id' => $image->id]);
                }
            }
        }

        return response()->json(['success' => true, 'url' => $url, 'path' => $path, 'image_id' => $image->id]);
    }

    public function listImages()
    {
        $images = [];

        $dbImages = Image::all(['id', 'path', 'name']);
        $seen = [];
        foreach ($dbImages as $img) {
            $url = $img->url;
            $images[] = [
                'image_id' => $img->id,
                'url' => $url,
                'path' => $img->path,
                'name' => $img->name,
            ];
            $seen[$img->path] = true;
        }

        $storageDisk = \Illuminate\Support\Facades\Storage::disk('public');
        $storageFiles = $storageDisk->allFiles();
        foreach ($storageFiles as $file) {
            if (!in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp', 'gif'])) continue;
            if (isset($seen[$file])) continue;
            $images[] = [
                'image_id' => null,
                'url' => asset('storage/' . $file),
                'path' => $file,
                'name' => basename($file),
            ];
            $seen[$file] = true;
        }

        $publicImgPath = public_path('img');
        if (is_dir($publicImgPath)) {
            foreach (scandir($publicImgPath) as $file) {
                if (!in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp', 'gif'])) continue;
                $key = 'img/' . $file;
                if (isset($seen[$key])) continue;
                $images[] = [
                    'image_id' => null,
                    'url' => asset('img/' . $file),
                    'path' => 'img/' . $file,
                    'name' => $file,
                ];
            }
        }

        return response()->json(['images' => $images]);
    }

    public function convertToWebp()
    {
        $exitCode = Artisan::call('images:to-webp');
        $output = Artisan::output();

        if ($exitCode === 0) {
            return response()->json(['success' => true, 'message' => 'Konversi WebP berhasil!', 'output' => $output]);
        }

        return response()->json(['success' => false, 'message' => 'Konversi gagal', 'output' => $output], 500);
    }

    public function deleteImage(\App\Models\Image $image)
    {
        try {
            if (\Illuminate\Support\Str::startsWith($image->path, 'storage/')) {
                $path = str_replace('storage/', '', $image->path);
                \Illuminate\Support\Facades\Storage::disk('public')->delete($path);
                // Try deleting webp counterpart
                $webpPath = pathinfo($path, PATHINFO_DIRNAME) . '/' . pathinfo($path, PATHINFO_FILENAME) . '.webp';
                \Illuminate\Support\Facades\Storage::disk('public')->delete($webpPath);
            }
            $image->delete();
            return response()->json(['success' => true, 'message' => 'Gambar berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
