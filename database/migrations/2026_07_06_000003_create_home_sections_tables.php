<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sect_home_hero', function (Blueprint $table) {
            $table->id();
            $table->string('badge')->nullable();
            $table->string('judul')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('btn_booking')->nullable();
            $table->string('btn_destinasi')->nullable();
            $table->string('stat_destinasi_angka')->nullable();
            $table->string('stat_destinasi_label')->nullable();
            $table->string('stat_armada_angka')->nullable();
            $table->string('stat_armada_label')->nullable();
            $table->string('stat_rating_angka')->nullable();
            $table->string('stat_rating_label')->nullable();
            $table->foreignId('gambar_latar_id')->nullable()->constrained('images')->nullOnDelete();
            $table->string('embed_video')->nullable();
            $table->timestamps();
        });

        Schema::create('sect_home_penawaran', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow')->nullable();
            $table->string('judul')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('sect_home_cta', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('sect_home_footer', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->text('tentang')->nullable();
            $table->string('copyright')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sect_home_footer');
        Schema::dropIfExists('sect_home_cta');
        Schema::dropIfExists('sect_home_penawaran');
        Schema::dropIfExists('sect_home_hero');
    }
};
