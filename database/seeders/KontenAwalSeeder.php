<?php

namespace Database\Seeders;

use App\Models\Destinasi;
use App\Models\Ulasan;
use App\Models\Galeri;
use App\Models\Artikel;
use App\Models\Image;
use Illuminate\Database\Seeder;

class KontenAwalSeeder extends Seeder
{
    public function run(): void
    {
        // ======================== DESTINASI ========================
        // Map gambar filename => image_id dari tabel images
        $imageMap = Image::all()->keyBy('name');
        $resolveImage = function (string $filename) use ($imageMap): ?int {
            $record = $imageMap->get($filename)
                ?? $imageMap->first(fn($img) => basename($img->path) === $filename);
            return $record ? $record->id : null;
        };

        $destinasi = [
            [
                'kategori' => 'Kawah Ijen',
                'nama' => 'Blue Fire Ijen Midnight',
                'slug' => 'blue-fire-ijen-midnight',
                'deskripsi' => 'Mulai perjalanan tengah malam menuju kawah biru Ijen yang legendaris. Nikmati fenomena blue fire yang langka, lalu saksikan sunrise spektakuler dari puncak kawah. Perjalanan ini mencakup transfer jeep dari berbagai titik di Banyuwangi, guide lokal berpengalaman, serta perlengkapan keselamatan lengkap.',
                'deskripsi_singkat' => 'Blue fire, sunrise, dan jeep transfer yang rapi.',
                'lokasi' => 'Kawah Ijen, Banyuwangi',
                'harga' => 1250000,
                'gambar_file' => 'unsplash_M8drGBgFNZE.png',
                'durasi' => '8 jam',
                'mood' => 'Sunrise',
                'rating' => '4.9',
                'label' => 'Mulai pagi',
                'rute' => 'Kawah Ijen Banyuwangi',
                'jml_ulasan' => 128,
                'tipe' => 'Private',
                'status' => 'aktif',
            ],
            [
                'kategori' => 'Hutan',
                'nama' => 'De Djawatan',
                'slug' => 'de-djawatan',
                'deskripsi' => 'Jelajahi hutan trembesi raksasa yang menjadi ikon Banyuwangi. De Djawatan menawarkan suasana teduh dengan pohon-pohon tinggi menjulang, cocok untuk foto-foto dan petualangan santai. Termasuk jeep transportasi dan guide lokal.',
                'deskripsi_singkat' => 'Trembesi raksasa dan jalur foto teduh.',
                'lokasi' => 'De Djawatan, Banyuwangi',
                'harga' => 350000,
                'gambar_file' => 'djawatan.jpg',
                'durasi' => '3 jam',
                'mood' => 'Santai',
                'rating' => '4.7',
                'label' => null,
                'rute' => 'Hutan De Djawatan',
                'jml_ulasan' => 89,
                'tipe' => 'Private',
                'status' => 'aktif',
            ],
            [
                'kategori' => 'Budaya',
                'nama' => 'Desa Wisata Kemiren',
                'slug' => 'desa-wisata-kemiren',
                'deskripsi' => 'Kunjungi desa adat Osing yang masih mempertahankan tradisi leluhur. Nikmati kopi lokal, saksikan tarian tradisional, dan belajar tentang kearifan lokal masyarakat Using. Paket ini termasuk transportasi jeep, guide, dan makan siang.',
                'deskripsi_singkat' => 'Kopi, tradisi Osing, dan cerita lokal.',
                'lokasi' => 'Desa Kemiren, Banyuwangi',
                'harga' => 450000,
                'gambar_file' => 'kemiren.png',
                'durasi' => '4 jam',
                'mood' => 'Budaya',
                'rating' => '4.8',
                'label' => null,
                'rute' => 'Kampung Adat Osing',
                'jml_ulasan' => 156,
                'tipe' => 'Open Trip',
                'status' => 'aktif',
            ],
            [
                'kategori' => 'Pantai',
                'nama' => 'Pantai Boom Banyuwangi',
                'slug' => 'pantai-boom-banyuwangi',
                'deskripsi' => 'Nikmati sunrise di Pantai Boom, ikon kota Banyuwangi yang indah. Dermaga panjang, angin laut sepoi, dan pemandangan Selat Bali membuat tempat ini sempurna untuk memulai hari. Paket termasuk jeep transportasi dan sarapan ringan.',
                'deskripsi_singkat' => 'Sunrise, dermaga, dan angin laut kota.',
                'lokasi' => 'Pantai Boom, Banyuwangi',
                'harga' => 250000,
                'gambar_file' => 'pantaiboom.png',
                'durasi' => '2 jam',
                'mood' => 'Sunrise',
                'rating' => '4.5',
                'label' => null,
                'rute' => 'Pantai Boom Marina',
                'jml_ulasan' => 234,
                'tipe' => 'Private',
                'status' => 'aktif',
            ],
            [
                'kategori' => 'Festival',
                'nama' => 'Gandrung Sewu',
                'slug' => 'gandrung-sewu',
                'deskripsi' => 'Saksikan ribuan penari Gandrung yang memukau dalam festival budaya tahunan Banyuwangi. Pengalaman budaya yang tak terlupakan dengan iringan musik tradisional dan kostum yang indah. Termasuk transportasi jeep dan tiket masuk.',
                'deskripsi_singkat' => 'Ribuan penari dan energi budaya pesisir.',
                'lokasi' => 'Banyuwangi Kota',
                'harga' => 550000,
                'gambar_file' => 'Tarian_Gandrung_sewu_03 1.png',
                'durasi' => '1 Hari',
                'mood' => 'Festival',
                'rating' => '4.9',
                'label' => null,
                'rute' => 'Festival Gandrung Sewu',
                'jml_ulasan' => 320,
                'tipe' => 'Eksklusif',
                'status' => 'aktif',
            ],
            [
                'kategori' => 'Petualangan',
                'nama' => 'Jalur Pancing Pancer',
                'slug' => 'jalur-pancing-pancer',
                'deskripsi' => 'Jelajahi jalur off-road yang menantang menuju destinasi favorit para pemancing. Medan berbatu dan pemandangan laut lepas yang spektakuler akan menemani perjalanan Anda. Jeep 4x4 tangguh siap membawa Anda melewati segala medan.',
                'deskripsi_singkat' => 'Off-road seru ke spot pancing favorit.',
                'lokasi' => 'Pancer, Banyuwangi',
                'harga' => 750000,
                'gambar_file' => 'unsplash_Souw06F1irM.png',
                'durasi' => '5 jam',
                'mood' => 'Petualangan',
                'rating' => '4.6',
                'label' => null,
                'rute' => 'Pancer Fishing Spot',
                'jml_ulasan' => 67,
                'tipe' => 'Private',
                'status' => 'aktif',
            ],
            [
                'kategori' => 'Wisata',
                'nama' => 'Jalur Suci Sembah',
                'slug' => 'jalur-suci-sembah',
                'deskripsi' => 'Perjalanan spiritual melewati jalur suci di kawasan Gunung Ijen. Nikmati ketenangan alam sambil belajar tentang sejarah dan budaya spiritual masyarakat setempat. Paket lengkap dengan guide dan transportasi.',
                'deskripsi_singkat' => 'Tranquil spiritual journey',
                'lokasi' => 'Gunung Ijen, Banyuwangi',
                'harga' => 950000,
                'gambar_file' => 'jembatan.png',
                'durasi' => '6 jam',
                'mood' => 'Spiritual',
                'rating' => '4.8',
                'label' => null,
                'rute' => 'Spiritual Trail Ijen',
                'jml_ulasan' => 45,
                'tipe' => 'Private',
                'status' => 'aktif',
            ],
        ];

        foreach ($destinasi as $data) {
            $gambarFile = $data['gambar_file'] ?? null;
            unset($data['gambar_file']);
            $data['image_id'] = $gambarFile ? $resolveImage($gambarFile) : null;
            Destinasi::firstOrCreate(['slug' => $data['slug']], $data);
        }
        $this->command->info('Destinasi: ' . count($destinasi) . ' data seeded.');

        // ======================== ULASAN ========================
        $ulasan = [
            [
                'bintang' => 5,
                'pesan' => 'Sangat terkesan dengan pelayanan JB. Driver ramah dan paham betul kondisi jalanan. Rute Hutan De Djawatan jadi super seru!',
                'gambar_profile' => null,
                'nama_user' => 'Andi Saputra',
                'kategori' => 'Trip Hutan',
                'ditampilkan' => true,
            ],
            [
                'bintang' => 4,
                'pesan' => 'Pengalaman kultural di Desa Kemiren sangat otentik. Jeep yang dipakai bersih dan mesinnya halus. Sangat direkomendasikan!',
                'gambar_profile' => null,
                'nama_user' => 'Rina Melati',
                'kategori' => 'Budaya Trip',
                'ditampilkan' => true,
            ],
            [
                'bintang' => 5,
                'pesan' => 'Tripnya sangat on-time dan profesional. Kendaraannya benar-benar tangguh melintasi jalanan berat tanpa hambatan sama sekali!',
                'gambar_profile' => null,
                'nama_user' => 'Dimas Kusuma',
                'kategori' => 'Open Trip',
                'ditampilkan' => true,
            ],
            [
                'bintang' => 5,
                'pesan' => 'Blue Fire Ijen adalah pengalaman yang luar biasa! Guide sangat berpengalaman dan jeepnya nyaman. Pasti balik lagi!',
                'gambar_profile' => null,
                'nama_user' => 'Sari Dewi',
                'kategori' => 'Ijen Trip',
                'ditampilkan' => true,
            ],
            [
                'bintang' => 4,
                'pesan' => 'Pantai Boom sunrise tour sangat indah. Jeep-nya bersih dan driver tepat waktu. Sarapan yang disediakan juga enak!',
                'gambar_profile' => null,
                'nama_user' => 'Budi Hartono',
                'kategori' => 'Sunrise Tour',
                'ditampilkan' => true,
            ],
            [
                'bintang' => 5,
                'pesan' => 'Gandrung Sewu festival benar-benar spektakuler! Terima kasih JB sudah mengatur semuanya dengan rapi. Sangat puas!',
                'gambar_profile' => null,
                'nama_user' => 'Mega Putri',
                'kategori' => 'Festival',
                'ditampilkan' => true,
            ],
        ];

        foreach ($ulasan as $data) {
            Ulasan::create($data);
        }
        $this->command->info('Ulasan: ' . count($ulasan) . ' data created.');

        // ======================== GALERI ========================
        $galeri = [
            [
                'kategori' => 'Destinasi',
                'judul' => 'Kawah Ijen Blue Fire',
                'gambar' => 'unsplash_M8drGBgFNZE.png',
                'deskripsi' => 'Fenomena blue fire di Kawah Ijen yang legendaris',
                'slug' => 'kawah-ijen-blue-fire',
            ],
            [
                'kategori' => 'Destinasi',
                'judul' => 'Hutan De Djawatan',
                'gambar' => 'djawatan.jpg',
                'deskripsi' => 'Trembesi raksasa di Hutan De Djawatan',
                'slug' => 'hutan-de-djawatan',
            ],
            [
                'kategori' => 'Budaya',
                'judul' => 'Desa Wisata Kemiren',
                'gambar' => 'kemiren.png',
                'deskripsi' => 'Kehidupan desa adat Osing di Kemiren',
                'slug' => 'desa-wisata-kemiren',
            ],
            [
                'kategori' => 'Destinasi',
                'judul' => 'Pantai Boom',
                'gambar' => 'pantaiboom.png',
                'deskripsi' => 'Sunrise di Pantai Boom Banyuwangi',
                'slug' => 'pantai-boom',
            ],
            [
                'kategori' => 'Budaya',
                'judul' => 'Tari Gandrung Sewu',
                'gambar' => 'Tarian_Gandrung_sewu_03 1.png',
                'deskripsi' => 'Festival Gandrung Sewu yang memukau',
                'slug' => 'tari-gandrung-sewu',
            ],
            [
                'kategori' => 'Armada',
                'judul' => 'Jeep 4x4 di Jalur Off-road',
                'gambar' => 'unsplash_Souw06F1irM.png',
                'deskripsi' => 'Jeep 4x4 tangguh melintasi medan berat',
                'slug' => 'jeep-off-road',
            ],
            [
                'kategori' => 'Armada',
                'judul' => 'Jeep Classic Hardtop',
                'gambar' => 'jembatan.png',
                'deskripsi' => 'Jeep classic hardtop yang ikonik dan bertenaga',
                'slug' => 'jeep-classic-hardtop',
            ],
            [
                'kategori' => 'Destinasi',
                'judul' => 'Pemandangan Alam Banyuwangi',
                'gambar' => 'bluefire.jpg',
                'deskripsi' => 'Keindahan alam Banyuwangi yang memukau',
                'slug' => 'pemandangan-alam-banyuwangi',
            ],
        ];

        foreach ($galeri as $data) {
            Galeri::create($data);
        }
        $this->command->info('Galeri: ' . count($galeri) . ' data created.');

        // ======================== ARTIKEL ========================
        $artikel = [
            [
                'judul' => 'Panduan Lengkap Liburan ke Banyuwangi 2026',
                'slug' => 'panduan-liburan-banyuwangi-2026',
                'konten' => '<p>Banyuwangi semakin populer sebagai destinasi wisata unggulan di Indonesia. Dengan bentang alam yang lengkap mulai dari pegunungan, hutan, pantai, hingga budaya yang kaya, kota di ujung timur Jawa ini menawarkan pengalaman liburan yang tak terlupakan.</p><h2>Destinasi Wajib Dikunjungi</h2><p>Kawah Ijen, De Djawatan, dan Desa Kemiren adalah tiga destinasi yang wajib masuk itinerary Anda. Masing-masing menawarkan pengalaman yang berbeda namun sama-sama memukau.</p><h2>Tips Berlibur</h2><p>Gunakan jasa jeep lokal untuk pengalaman yang lebih autentik. Driver lokal paham betul medan dan kondisi jalan, plus mereka tahu spot-spot foto terbaik!</p>',
                'gambar' => 'unsplash_M8drGBgFNZE.png',
                'kategori' => 'Tips Wisata',
                'penulis' => 'Tim Jadi Berangkat',
                'durasi_baca' => 5,
                'status' => 'terbit',
                'tanggal_terbit' => '2026-06-15',
            ],
            [
                'judul' => 'Mengenal Tradisi Osing di Desa Kemiren',
                'slug' => 'tradisi-osing-desa-kemiren',
                'konten' => '<p>Desa Kemiren adalah salah satu desa adat suku Osing yang masih mempertahankan tradisi leluhur hingga kini. Terletak di kaki Gunung Ijen, desa ini menawarkan pengalaman budaya yang autentik bagi para pengunjung.</p><h2>Kearifan Lokal</h2><p>Masyarakat Osing memiliki tradisi unik seperti Tari Gandrung, Barong Ider Bumi, dan berbagai upacara adat lainnya. Pengunjung dapat belajar membuat kopi tradisional, menenun, dan memasak masakan khas Osing.</p><h2>Paket Wisata Budaya</h2><p>Jadi Berangkat menawarkan paket wisata budaya ke Desa Kemiren dengan durasi 4 jam, termasuk transportasi jeep, guide lokal, dan makan siang.</p>',
                'gambar' => 'kemiren.png',
                'kategori' => 'Budaya',
                'penulis' => 'Tim Jadi Berangkat',
                'durasi_baca' => 4,
                'status' => 'terbit',
                'tanggal_terbit' => '2026-06-20',
            ],
            [
                'judul' => '5 Spot Foto Terbaik di Banyuwangi untuk Instagram',
                'slug' => 'spot-foto-banyuwangi-instagram',
                'konten' => '<p>Banyuwangi memiliki banyak spot foto instagramable yang sayang untuk dilewatkan. Dari pemandangan alam hingga spot urban, berikut adalah 5 rekomendasi terbaik.</p><h2>1. Kawah Ijen</h2><p>Spot sunrise di puncak Kawah Ijen adalah yang terbaik. Kabut pagi yang tipis dan sinar matahari keemasan menciptakan latar foto yang dramatis.</p><h2>2. Hutan De Djawatan</h2><p>Pohon trembesi raksasa dengan cabang-cabang yang menjuntai menciptakan efek hutan mistis yang sangat fotogenik.</p><h2>3. Pantai Boom</h2><p>Dermaga panjang Pantai Boom adalah spot favorit untuk foto sunrise dengan latar Selat Bali dan Gunung Merapi.</p><h2>4. Desa Kemiren</h2><p>Arsitektur tradisional Osing dengan gapura khas dan rumah adat yang warna-warni sangat menarik untuk difoto.</p><h2>5. Perkebunan Kopi</h2><p>Kebun kopi hijau di lereng Gunung Ijen menawarkan pemandangan yang menenangkan dan spot foto yang estetik.</p>',
                'gambar' => 'djawatan.jpg',
                'kategori' => 'Tips Wisata',
                'penulis' => 'Tim Jadi Berangkat',
                'durasi_baca' => 3,
                'status' => 'terbit',
                'tanggal_terbit' => '2026-06-25',
            ],
        ];

        foreach ($artikel as $data) {
            Artikel::create($data);
        }
        $this->command->info('Artikel: ' . count($artikel) . ' data created.');
    }
}
