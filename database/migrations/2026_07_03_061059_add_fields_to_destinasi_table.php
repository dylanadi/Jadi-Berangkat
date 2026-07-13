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
        Schema::table('destinasi', function (Blueprint $table) {
            $table->string('label')->nullable()->after('nama');
            $table->string('rute')->nullable()->after('lokasi');
            $table->integer('jml_ulasan')->default(0)->after('rating');
            $table->string('deskripsi_singkat')->nullable()->after('deskripsi');
            $table->string('tipe')->default('Private')->after('mood');
        });
    }

    public function down(): void
    {
        Schema::table('destinasi', function (Blueprint $table) {
            $table->dropColumn(['label', 'rute', 'jml_ulasan', 'deskripsi_singkat', 'tipe']);
        });
    }
};
