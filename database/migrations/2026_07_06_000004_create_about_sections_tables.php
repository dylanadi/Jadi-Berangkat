<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sect_about_hero', function (Blueprint $table) {
            $table->id();
            $table->string('badge')->nullable();
            $table->string('judul')->nullable();
            $table->text('konten')->nullable();
            $table->string('stat_1_angka')->nullable();
            $table->string('stat_1_label')->nullable();
            $table->string('stat_2_angka')->nullable();
            $table->string('stat_2_label')->nullable();
            $table->string('stat_3_angka')->nullable();
            $table->string('stat_3_label')->nullable();
            $table->string('stat_4_angka')->nullable();
            $table->string('stat_4_label')->nullable();
            $table->foreignId('gambar_id')->nullable()->constrained('images')->nullOnDelete();
            $table->string('badge_premium')->nullable();
            $table->string('caption')->nullable();
            $table->timestamps();
        });

        Schema::create('sect_kisah', function (Blueprint $table) {
            $table->id();
            $table->string('badge')->nullable();
            $table->string('judul')->nullable();
            $table->text('deskripsi_1')->nullable();
            $table->text('deskripsi_2')->nullable();
            $table->text('highlight_text')->nullable();
            $table->foreignId('gambar_1_id')->nullable()->constrained('images')->nullOnDelete();
            $table->foreignId('gambar_2_id')->nullable()->constrained('images')->nullOnDelete();
            $table->string('badge_text')->nullable();
            $table->timestamps();
        });

        Schema::create('sect_visimisi', function (Blueprint $table) {
            $table->id();
            $table->string('badge')->nullable();
            $table->string('judul')->nullable();
            $table->text('visi_deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('misi_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sect_visimisi_id')->constrained('sect_visimisi')->onDelete('cascade');
            $table->string('nomor')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('sect_nilai', function (Blueprint $table) {
            $table->id();
            $table->string('badge')->nullable();
            $table->string('judul')->nullable();
            $table->timestamps();
        });

        Schema::create('card_nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sect_nilai_id')->constrained('sect_nilai')->onDelete('cascade');
            $table->string('icon')->nullable();
            $table->string('judul')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('sect_galeri_about', function (Blueprint $table) {
            $table->id();
            $table->string('label')->nullable();
            $table->string('judul')->nullable();
            $table->string('tombol_teks')->nullable();
            $table->timestamps();
        });

        Schema::create('galeri_item_about', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sect_galeri_about_id')->constrained('sect_galeri_about')->onDelete('cascade');
            $table->foreignId('gambar_id')->nullable()->constrained('images')->nullOnDelete();
            $table->string('tag')->nullable();
            $table->boolean('is_video')->default(false);
            $table->string('video_url')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_item_about');
        Schema::dropIfExists('sect_galeri_about');
        Schema::dropIfExists('card_nilai');
        Schema::dropIfExists('sect_nilai');
        Schema::dropIfExists('misi_item');
        Schema::dropIfExists('sect_visimisi');
        Schema::dropIfExists('sect_kisah');
        Schema::dropIfExists('sect_about_hero');
    }
};
