<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\SectHomeHero;
use App\Models\SectHomePenawaran;
use App\Models\SectHomeCta;
use App\Models\SectHomeFooter;
use App\Models\SectAboutHero;
use App\Models\SectKisah;
use App\Models\SectVisimisi;
use App\Models\MisiItem;
use App\Models\SectNilai;
use App\Models\CardNilai;
use App\Models\SectGaleriAbout;
use App\Models\GaleriItemAbout;
use App\Models\HalamanStatis;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SectionDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedImages();
        $this->seedHomeSections();
        $this->seedAboutSections();
    }

    protected function seedImages(): void
    {
        $disk = Storage::disk('public');
        $files = $disk->allFiles();
        $extensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

        foreach ($files as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($ext, $extensions)) {
                Image::firstOrCreate(
                    ['path' => $file],
                    [
                        'name' => pathinfo($file, PATHINFO_FILENAME),
                        'alt' => pathinfo($file, PATHINFO_FILENAME),
                        'disk' => 'public',
                    ]
                );
            }
        }

        $publicImgPath = public_path('img');
        if (is_dir($publicImgPath)) {
            foreach (scandir($publicImgPath) as $file) {
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($ext, $extensions)) {
                    Image::firstOrCreate(
                        ['path' => 'img/' . $file],
                        [
                            'name' => pathinfo($file, PATHINFO_FILENAME),
                            'alt' => pathinfo($file, PATHINFO_FILENAME),
                            'disk' => 'local',
                        ]
                    );
                }
            }
        }

        $this->command->info('Images seeded: ' . Image::count());
    }

    protected function seedHomeSections(): void
    {
        $page = HalamanStatis::where('tipe', 'beranda')->first();
        if (!$page) return;

        $data = json_decode($page->konten, true) ?: [];

        SectHomeHero::firstOrCreate(['id' => 1], [
            'badge' => $data['hero_badge'] ?? 'Jeep trip Banyuwangi',
            'judul' => $data['hero_judul'] ?? 'Trip alam yang rapi dari awal sampai pulang.',
            'deskripsi' => $data['hero_deskripsi'] ?? 'Pilih rute, tambah perlengkapan, lalu berangkat dengan jeep terawat dan driver lokal yang paham medan.',
            'btn_booking' => $data['button_booking'] ?? 'Booking Trip',
            'btn_destinasi' => $data['button_destinasi'] ?? 'Lihat Destinasi',
            'stat_destinasi_angka' => $data['hero_jumlah_destinasi'] ?? '25',
            'stat_destinasi_label' => $data['stat_hero_destinasi_label'] ?? 'Destinasi',
            'stat_armada_angka' => $data['hero_jumlah_armada'] ?? '120',
            'stat_armada_label' => $data['stat_armada_label'] ?? 'Armada',
            'stat_rating_angka' => $data['hero_rating'] ?? '4.9',
            'stat_rating_label' => $data['stat_rating_label'] ?? 'Rating',
            'embed_video' => $data['embed_video'] ?? 'https://www.youtube.com/embed/qNVdijuWwGo',
        ]);

        SectHomePenawaran::firstOrCreate(['id' => 1], [
            'eyebrow' => $data['eyebrow_paket'] ?? 'Penawaran',
            'judul' => $data['paket_judul'] ?? 'Paket yang paling sering dipesan.',
            'deskripsi' => $data['paket_deskripsi'] ?? '',
        ]);

        SectHomeCta::firstOrCreate(['id' => 1], [
            'judul' => $data['cta_judul'] ?? 'Siap Mulai Petualangan?',
            'deskripsi' => $data['cta_deskripsi'] ?? 'Hubungi tim kami untuk pertanyaan, reservasi, atau custom trip.',
        ]);

        SectHomeFooter::firstOrCreate(['id' => 1], [
            'judul' => $data['footer_judul'] ?? 'Jadi Berangkat',
            'tentang' => $data['footer_tentang'] ?? 'Platform penyedia layanan penyewaan Jeep wisata premium.',
            'copyright' => $data['footer_copyright'] ?? '© ' . date('Y') . ' Jadi Berangkat. All rights reserved.',
        ]);

        $this->command->info('Home sections seeded.');
    }

    protected function seedAboutSections(): void
    {
        $page = HalamanStatis::where('tipe', 'tentang')->first();
        if (!$page) return;

        $data = json_decode($page->konten, true) ?: [];

        $heroImgId = null;
        $img = Image::where('path', 'img/pantaipelengkung.webp')->first();
        if ($img) $heroImgId = $img->id;

        SectAboutHero::firstOrCreate(['id' => 1], [
            'badge' => $data['tentang_badge'] ?? 'Tentang Kami',
            'judul' => $data['judul'] ?? 'Petualangan Terbaik',
            'konten' => $data['konten'] ?? '',
            'stat_1_angka' => $data['tentang_stat_tahun_angka'] ?? '5',
            'stat_1_label' => $data['tentang_stat_tahun_label'] ?? 'Tahun Pengalaman',
            'stat_2_angka' => $data['tentang_stat_wisatawan_angka'] ?? '2000',
            'stat_2_label' => $data['tentang_stat_wisatawan_label'] ?? 'Wisatawan Dilayani',
            'stat_3_angka' => $data['tentang_stat_rute_angka'] ?? '20',
            'stat_3_label' => $data['tentang_stat_rute_label'] ?? 'Rute Destinasi',
            'stat_4_angka' => $data['tentang_stat_armada_angka'] ?? '15',
            'stat_4_label' => $data['tentang_stat_armada_label'] ?? 'Armada Jeep 4x4',
            'gambar_id' => $heroImgId,
            'badge_premium' => $data['tentang_badge_premium'] ?? 'Premium Service',
            'caption' => $data['tentang_caption'] ?? 'Jelajahi Keindahan Alami Bersama Driver Profesional',
        ]);

        $kisahImg1 = Image::where('path', 'img/unsplash_M8drGBgFNZE.webp')->first();
        $kisahImg2 = Image::where('path', 'img/unsplash_Souw06F1irM.webp')->first();

        SectKisah::firstOrCreate(['id' => 1], [
            'badge' => $data['tentang_kisah_badge'] ?? 'Kisah Kami',
            'judul' => $data['tentang_kisah_judul'] ?? 'Lahir dari Kecintaan pada Alam Banyuwangi',
            'deskripsi_1' => $data['tentang_kisah_p1'] ?? '',
            'deskripsi_2' => $data['tentang_kisah_p2'] ?? '',
            'highlight_text' => $data['tentang_kisah_p3'] ?? '',
            'gambar_1_id' => $kisahImg1?->id,
            'gambar_2_id' => $kisahImg2?->id,
            'badge_text' => $data['badge_text'] ?? '100% Local Empowerment',
        ]);

        SectVisimisi::firstOrCreate(['id' => 1], [
            'badge' => $data['tentang_visimisi_badge'] ?? 'Landasan Kami',
            'judul' => $data['tentang_visimisi_judul'] ?? 'Visi & Misi Perusahaan',
            'visi_deskripsi' => $data['tentang_visi_text'] ?? '',
        ]);

        $visimisi = SectVisimisi::first();
        if ($visimisi && MisiItem::where('sect_visimisi_id', $visimisi->id)->count() === 0) {
            $misiItems = [
                ['nomor' => '01', 'deskripsi' => $data['tentang_misi_item_1'] ?? 'Kasih pengalaman jalan-jalan paling seru, aman, dan berkesan tanpa ribet.'],
                ['nomor' => '02', 'deskripsi' => $data['tentang_misi_item_2'] ?? 'Driver lokal yang ramah, paham medan, dan tahu cerita-cerita seru tiap sudut Banyuwangi.'],
                ['nomor' => '03', 'deskripsi' => $data['tentang_misi_item_3'] ?? 'Bikin reservasi semudah chat sama teman — cepat, transparan, tanpa banyak syarat.'],
                ['nomor' => '04', 'deskripsi' => $data['tentang_misi_item_4'] ?? 'Pastiin tiap perjalanan juga ngasih dampak baik buat alam dan warga lokal Banyuwangi.'],
            ];
            foreach ($misiItems as $item) {
                MisiItem::create(array_merge($item, ['sect_visimisi_id' => $visimisi->id]));
            }
        }

        SectNilai::firstOrCreate(['id' => 1], [
            'badge' => $data['tentang_nilai_badge'] ?? 'Nilai Kami',
            'judul' => $data['tentang_nilai_judul'] ?? 'Mengapa Pilih Jadi Berangkat?',
        ]);

        $nilai = SectNilai::first();
        if ($nilai && CardNilai::where('sect_nilai_id', $nilai->id)->count() === 0) {
            $nilaiCards = [
                ['icon' => 'bi-shield-check', 'judul' => $data['tentang_nilai_item_1_judul'] ?? 'Keamanan Terjamin', 'deskripsi' => $data['tentang_nilai_item_1_desc'] ?? 'Armada Jeep 4x4 terinspeksi rutin dengan standar keselamatan wisata internasional.', 'urutan' => 1],
                ['icon' => 'bi-tree', 'judul' => $data['tentang_nilai_item_2_judul'] ?? 'Eco-Tourism', 'deskripsi' => $data['tentang_nilai_item_2_desc'] ?? 'Beroperasi dengan prinsip pariwisata berkelanjutan.', 'urutan' => 2],
                ['icon' => 'bi-person-badge', 'judul' => $data['tentang_nilai_item_3_judul'] ?? 'Guide Lokal Expert', 'deskripsi' => $data['tentang_nilai_item_3_desc'] ?? 'Driver sekaligus pemandu lokal berpengalaman.', 'urutan' => 3],
                ['icon' => 'bi-phone-vibrate', 'judul' => $data['tentang_nilai_item_4_judul'] ?? 'Booking Digital', 'deskripsi' => $data['tentang_nilai_item_4_desc'] ?? 'Sistem reservasi digital yang mudah.', 'urutan' => 4],
                ['icon' => 'bi-gem', 'judul' => $data['tentang_nilai_item_5_judul'] ?? 'Pengalaman Premium', 'deskripsi' => $data['tentang_nilai_item_5_desc'] ?? 'Ribuan tamu telah merasakan pengalaman wisata berkesan.', 'urutan' => 5],
                ['icon' => 'bi-people', 'judul' => $data['tentang_nilai_item_6_judul'] ?? 'Komunitas Lokal', 'deskripsi' => $data['tentang_nilai_item_6_desc'] ?? 'Setiap kunjungan berkontribusi langsung pada perekonomian masyarakat lokal.', 'urutan' => 6],
            ];
            foreach ($nilaiCards as $card) {
                CardNilai::create(array_merge($card, ['sect_nilai_id' => $nilai->id]));
            }
        }

        SectGaleriAbout::firstOrCreate(['id' => 1], [
            'label' => 'Galeri Kegiatan',
            'judul' => 'Momen Bersama Kami',
            'tombol_teks' => 'Koleksi Media',
        ]);

        $galeriSection = SectGaleriAbout::first();
        if ($galeriSection && GaleriItemAbout::where('sect_galeri_about_id', $galeriSection->id)->count() === 0) {
            $galeriImages = [
                ['path' => 'img/laut.webp', 'tag' => 'EKSPEDISI IJEN'],
                ['path' => 'img/bluefire (1).webp', 'tag' => 'MOMEN SAVANA'],
            ];
            foreach ($galeriImages as $i => $gi) {
                $imgRecord = Image::where('path', $gi['path'])->first();
                GaleriItemAbout::create([
                    'sect_galeri_about_id' => $galeriSection->id,
                    'gambar_id' => $imgRecord?->id,
                    'tag' => $gi['tag'],
                    'is_video' => false,
                    'urutan' => $i + 1,
                ]);
            }
            GaleriItemAbout::create([
                'sect_galeri_about_id' => $galeriSection->id,
                'is_video' => true,
                'video_url' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=600',
                'tag' => 'PESISIR',
                'urutan' => 3,
            ]);
            GaleriItemAbout::create([
                'sect_galeri_about_id' => $galeriSection->id,
                'is_video' => false,
                'tag' => 'Meru Betiri team',
                'urutan' => 4,
            ]);
            GaleriItemAbout::create([
                'sect_galeri_about_id' => $galeriSection->id,
                'is_video' => true,
                'video_url' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?q=80&w=600',
                'tag' => 'GUNUNG',
                'urutan' => 5,
            ]);
        }

        $this->command->info('About sections seeded.');
    }
}
