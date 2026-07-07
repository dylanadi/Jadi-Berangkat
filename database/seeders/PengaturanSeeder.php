<?php

namespace Database\Seeders;

use App\Models\PengaturanHalamanDepan;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'jumlah_destinasi', 'value' => '25', 'tipe' => 'angka'],
            ['key' => 'jumlah_armada', 'value' => '120', 'tipe' => 'angka'],
            ['key' => 'pengunjung', 'value' => '12', 'tipe' => 'angka'],
            ['key' => 'jumlah_rute', 'value' => '50', 'tipe' => 'angka'],
            ['key' => 'hero_judul', 'value' => 'Trip alam yang rapi dari awal sampai pulang.', 'tipe' => 'text'],
            ['key' => 'hero_subjudul', 'value' => 'Pilih rute, tambah perlengkapan, lalu berangkat dengan jeep terawat dan driver lokal yang paham medan.', 'tipe' => 'text'],
            ['key' => 'cta_judul', 'value' => 'Siap menjelajah Banyuwangi?', 'tipe' => 'text'],
            ['key' => 'cta_subjudul', 'value' => 'Booking jeep-mu sekarang dan nikmati trip alam yang rapi dari awal sampai pulang.', 'tipe' => 'text'],
            ['key' => 'copyright', 'value' => '© 2026 Jadi Berangkat. All rights reserved.', 'tipe' => 'text'],
        ];

        foreach ($settings as $setting) {
            PengaturanHalamanDepan::create($setting);
        }
    }
}
