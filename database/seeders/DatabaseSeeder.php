<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@jadiberangkat.com',
            'password' => bcrypt('password'),
        ]);

        $this->call([
            PengaturanSeeder::class,
            HalamanStatisSeeder::class,
            ImageSeeder::class,       // harus sebelum KontenAwalSeeder
            KontenAwalSeeder::class,
            SectionDataSeeder::class,
        ]);
    }
}
