<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Seed tabel images dengan semua gambar yang ada di public/img/.
     * Tabel ini berfungsi sebagai repositori terpusat untuk path gambar,
     * sehingga tabel lain (destinasi, galeri, artikel, ulasan) cukup menyimpan image_id.
     *
     * Struktur tabel images: id, name, path, alt, disk
     */
    public function run(): void
    {
        $images = [
            [
                'name' => 'Blue Fire Ijen',
                'path' => 'unsplash_M8drGBgFNZE.png',
                'alt'  => 'Kawah Ijen Blue Fire - fenomena api biru yang legendaris',
                'disk' => 'public',
            ],
            [
                'name' => 'De Djawatan',
                'path' => 'djawatan.jpg',
                'alt'  => 'Hutan De Djawatan - trembesi raksasa di Banyuwangi',
                'disk' => 'public',
            ],
            [
                'name' => 'Desa Kemiren',
                'path' => 'kemiren.png',
                'alt'  => 'Desa Wisata Kemiren - desa adat suku Osing',
                'disk' => 'public',
            ],
            [
                'name' => 'Pantai Boom',
                'path' => 'pantaiboom.png',
                'alt'  => 'Pantai Boom Banyuwangi - sunrise di dermaga',
                'disk' => 'public',
            ],
            [
                'name' => 'Gandrung Sewu',
                'path' => 'Tarian_Gandrung_sewu_03 1.png',
                'alt'  => 'Festival Gandrung Sewu - ribuan penari tradisional',
                'disk' => 'public',
            ],
            [
                'name' => 'Jalur Off-road Pancer',
                'path' => 'unsplash_Souw06F1irM.png',
                'alt'  => 'Jalur Off-road Pancer - jeep 4x4 di medan berat',
                'disk' => 'public',
            ],
            [
                'name' => 'Jembatan Ijen',
                'path' => 'jembatan.png',
                'alt'  => 'Jalur Suci Sembah - jembatan di kawasan Ijen',
                'disk' => 'public',
            ],
            [
                'name' => 'Blue Fire Ijen (Alt)',
                'path' => 'bluefire.jpg',
                'alt'  => 'Pemandangan alam Banyuwangi yang memukau',
                'disk' => 'public',
            ],
            [
                'name' => 'Laut Banyuwangi',
                'path' => 'laut.png',
                'alt'  => 'Pemandangan laut Banyuwangi',
                'disk' => 'public',
            ],
            [
                'name' => 'Pantai Plengkung',
                'path' => 'pantaipelengkung.png',
                'alt'  => 'Pantai Plengkung (G-Land) - surga surfing',
                'disk' => 'public',
            ],
            [
                'name' => 'Tari Gandrung',
                'path' => 'gandrung1.png',
                'alt'  => 'Tari Gandrung - tarian khas Banyuwangi',
                'disk' => 'public',
            ],
            [
                'name' => 'Pictogram Wisata',
                'path' => 'picto.png',
                'alt'  => 'Pictogram wisata Banyuwangi',
                'disk' => 'public',
            ],
            [
                'name' => 'Pantai Sukamade',
                'path' => 'Pantaisukamade.png',
                'alt'  => 'Pantai Sukamade - lokasi penyu bertelur',
                'disk' => 'public',
            ],
        ];

        foreach ($images as $data) {
            // Cek apakah path sudah ada, jika ada skip (idempoten)
            Image::firstOrCreate(['path' => $data['path']], $data);
        }

        $this->command->info('Images: ' . count($images) . ' data processed.');
    }
}
