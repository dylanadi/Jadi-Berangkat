<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            ['nama_kategori' => 'Wisata', 'icon' => 'bi bi-geo-alt-fill'],
            ['nama_kategori' => 'Pantai', 'icon' => 'bi bi-water'],
            ['nama_kategori' => 'Pegunungan', 'icon' => 'bi bi-image'],
            ['nama_kategori' => 'Hutan', 'icon' => 'bi bi-tree-fill'],
            ['nama_kategori' => 'Budaya', 'icon' => 'bi bi-bank2'],
            ['nama_kategori' => 'Festival', 'icon' => 'bi bi-balloon-fill'],
            ['nama_kategori' => 'Petualangan', 'icon' => 'bi bi-compass-fill'],
            ['nama_kategori' => 'Armada', 'icon' => 'bi bi-truck'],
            ['nama_kategori' => 'Destinasi', 'icon' => 'bi bi-map-fill'],
            ['nama_kategori' => 'Open Trip', 'icon' => 'bi bi-people-fill'],
            ['nama_kategori' => 'Kawah Ijen', 'icon' => 'bi bi-volcano'],
            ['nama_kategori' => 'Tips Wisata', 'icon' => 'bi bi-lightbulb-fill'],
            ['nama_kategori' => 'Trip Hutan', 'icon' => 'bi bi-tree'],
            ['nama_kategori' => 'Budaya Trip', 'icon' => 'bi bi-bank'],
            ['nama_kategori' => 'Ijen Trip', 'icon' => 'bi bi-fire'],
            ['nama_kategori' => 'Sunrise Tour', 'icon' => 'bi bi-brightness-alt-high-fill'],
        ];

        foreach ($kategoris as $kat) {
            Kategori::firstOrCreate(['nama_kategori' => $kat['nama_kategori']], $kat);
        }
    }
}
