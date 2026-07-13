<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_perjalanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destinasi_id')->constrained('destinasi')->cascadeOnDelete();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_perjalanan');
    }
};
