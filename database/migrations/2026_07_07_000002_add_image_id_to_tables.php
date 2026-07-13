<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tambahkan kolom image_id ke tabel yang menggunakan gambar,
     * sebagai foreign key ke tabel images terpusat.
     * Kolom gambar lama dibiarkan nullable sebagai fallback.
     * Cek terlebih dahulu sebelum menambah (idempoten).
     */
    public function up(): void
    {
        // Tambah image_id ke tabel destinasi (jika belum ada)
        if (!Schema::hasColumn('destinasi', 'image_id')) {
            Schema::table('destinasi', function (Blueprint $table) {
                $table->foreignId('image_id')->nullable()->after('harga')
                      ->constrained('images')->nullOnDelete();
            });
        }

        // Tambah image_id ke tabel galeri (jika belum ada)
        if (!Schema::hasColumn('galeri', 'image_id')) {
            Schema::table('galeri', function (Blueprint $table) {
                $table->foreignId('image_id')->nullable()->after('gambar')
                      ->constrained('images')->nullOnDelete();
            });
        }

        // Tambah image_id ke tabel artikel (jika belum ada)
        if (!Schema::hasColumn('artikel', 'image_id')) {
            Schema::table('artikel', function (Blueprint $table) {
                $table->foreignId('image_id')->nullable()->after('gambar')
                      ->constrained('images')->nullOnDelete();
            });
        }

        // Tambah image_id ke tabel ulasan (untuk gambar profil reviewer, jika belum ada)
        if (!Schema::hasColumn('ulasan', 'image_id')) {
            Schema::table('ulasan', function (Blueprint $table) {
                $table->foreignId('image_id')->nullable()->after('gambar_profile')
                      ->constrained('images')->nullOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('destinasi', 'image_id')) {
            Schema::table('destinasi', function (Blueprint $table) {
                $table->dropForeign(['image_id']);
                $table->dropColumn('image_id');
            });
        }

        if (Schema::hasColumn('galeri', 'image_id')) {
            Schema::table('galeri', function (Blueprint $table) {
                $table->dropForeign(['image_id']);
                $table->dropColumn('image_id');
            });
        }

        if (Schema::hasColumn('artikel', 'image_id')) {
            Schema::table('artikel', function (Blueprint $table) {
                $table->dropForeign(['image_id']);
                $table->dropColumn('image_id');
            });
        }

        if (Schema::hasColumn('ulasan', 'image_id')) {
            Schema::table('ulasan', function (Blueprint $table) {
                $table->dropForeign(['image_id']);
                $table->dropColumn('image_id');
            });
        }
    }
};
