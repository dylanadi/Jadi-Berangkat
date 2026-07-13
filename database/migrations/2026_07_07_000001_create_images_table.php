<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Buat tabel images jika belum ada.
     * Tabel ini menjadi repositori terpusat untuk semua path gambar.
     */
    public function up(): void
    {
        if (!Schema::hasTable('images')) {
            Schema::create('images', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();       // nama deskriptif gambar
                $table->string('path');                   // nama file, contoh: unsplash_M8drGBgFNZE.png
                $table->string('alt')->nullable();        // alt text untuk aksesibilitas
                $table->string('disk')->default('public'); // disk storage (public/local/s3)
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
