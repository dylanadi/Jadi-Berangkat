<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tables = ['destinasi', 'galeri', 'artikel', 'ulasan'];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->unsignedBigInteger('kategori_id')->nullable()->after('id');
                // We add the foreign key constraint
                $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('set null');
            });

            // Map string to kategori_id
            $records = DB::table($tableName)->get();
            foreach ($records as $record) {
                if (!empty($record->kategori)) {
                    $kategoriModel = Kategori::firstOrCreate(['nama_kategori' => $record->kategori]);
                    DB::table($tableName)->where('id', $record->id)->update(['kategori_id' => $kategoriModel->id]);
                }
            }

            // Drop string column
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('kategori');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['destinasi', 'galeri', 'artikel', 'ulasan'];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->string('kategori')->nullable()->after('kategori_id');
            });

            $records = DB::table($tableName)->get();
            foreach ($records as $record) {
                if (!empty($record->kategori_id)) {
                    $kategoriModel = Kategori::find($record->kategori_id);
                    if ($kategoriModel) {
                        DB::table($tableName)->where('id', $record->id)->update(['kategori' => $kategoriModel->nama_kategori]);
                    }
                }
            }

            Schema::table($tableName, function (Blueprint $table) {
                $table->dropForeign(['kategori_id']);
                $table->dropColumn('kategori_id');
            });
        }
    }
};
