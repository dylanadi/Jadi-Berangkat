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
            $table->unsignedBigInteger('image_id')->nullable()->after('harga');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('set null');
        });

        // Migrate existing gambar to images table
        $destinasis = DB::table('destinasi')->get();
        foreach ($destinasis as $destinasi) {
            if ($destinasi->gambar) {
                // Check if image exists in images table by name
                $existingImage = DB::table('images')->where('name', $destinasi->gambar)->orWhere('path', $destinasi->gambar)->first();
                $imageId = null;
                if ($existingImage) {
                    $imageId = $existingImage->id;
                } else {
                    $path = Str::startsWith($destinasi->gambar, 'img/') ? $destinasi->gambar : 'img/' . $destinasi->gambar;
                    $imageId = DB::table('images')->insertGetId([
                        'name' => $destinasi->gambar,
                        'path' => $path,
                        'disk' => 'public',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                DB::table('destinasi')->where('id', $destinasi->id)->update(['image_id' => $imageId]);
            }
        }

        Schema::table('destinasi', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destinasi', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('harga');
        });

        // Revert data if possible
        $destinasis = DB::table('destinasi')->get();
        foreach ($destinasis as $destinasi) {
            if ($destinasi->image_id) {
                $image = DB::table('images')->where('id', $destinasi->image_id)->first();
                if ($image) {
                    DB::table('destinasi')->where('id', $destinasi->id)->update(['gambar' => $image->name]);
                }
            }
        }

        Schema::table('destinasi', function (Blueprint $table) {
            $table->dropForeign(['image_id']);
            $table->dropColumn('image_id');
        });
    }
};
