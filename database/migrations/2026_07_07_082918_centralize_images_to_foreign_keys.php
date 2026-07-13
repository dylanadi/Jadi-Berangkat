<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add image_id columns
        Schema::table('ulasan', function (Blueprint $table) {
            $table->unsignedBigInteger('image_id')->nullable()->after('gambar_profile');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('set null');
        });

        Schema::table('galeri', function (Blueprint $table) {
            $table->unsignedBigInteger('image_id')->nullable()->after('gambar');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('set null');
        });

        Schema::table('artikel', function (Blueprint $table) {
            $table->unsignedBigInteger('image_id')->nullable()->after('gambar');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('set null');
        });

        // 2. Migrate Data
        $this->migrateData('ulasan', 'gambar_profile');
        $this->migrateData('galeri', 'gambar');
        $this->migrateData('artikel', 'gambar');

        // 3. Drop old columns
        Schema::table('ulasan', function (Blueprint $table) {
            $table->dropColumn('gambar_profile');
        });
        Schema::table('galeri', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
        Schema::table('artikel', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }

    private function migrateData($table, $oldColumn)
    {
        $items = DB::table($table)->get();
        foreach ($items as $item) {
            if (!empty($item->{$oldColumn})) {
                $gambar = $item->{$oldColumn};
                
                $existingImage = DB::table('images')->where('name', $gambar)->orWhere('path', $gambar)->first();
                $imageId = null;
                
                if ($existingImage) {
                    $imageId = $existingImage->id;
                } else {
                    $path = Str::startsWith($gambar, 'img/') ? $gambar : 'img/' . $gambar;
                    $imageId = DB::table('images')->insertGetId([
                        'name' => $gambar,
                        'path' => $path,
                        'disk' => 'public',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                
                DB::table($table)->where('id', $item->id)->update(['image_id' => $imageId]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert columns
        Schema::table('ulasan', function (Blueprint $table) {
            $table->string('gambar_profile')->nullable()->after('image_id');
        });
        Schema::table('galeri', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('image_id');
        });
        Schema::table('artikel', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('image_id');
        });

        $this->revertData('ulasan', 'gambar_profile');
        $this->revertData('galeri', 'gambar');
        $this->revertData('artikel', 'gambar');

        Schema::table('ulasan', function (Blueprint $table) {
            $table->dropForeign(['image_id']);
            $table->dropColumn('image_id');
        });
        Schema::table('galeri', function (Blueprint $table) {
            $table->dropForeign(['image_id']);
            $table->dropColumn('image_id');
        });
        Schema::table('artikel', function (Blueprint $table) {
            $table->dropForeign(['image_id']);
            $table->dropColumn('image_id');
        });
    }

    private function revertData($table, $oldColumn)
    {
        $items = DB::table($table)->get();
        foreach ($items as $item) {
            if ($item->image_id) {
                $image = DB::table('images')->where('id', $item->image_id)->first();
                if ($image) {
                    DB::table($table)->where('id', $item->id)->update([$oldColumn => $image->name]);
                }
            }
        }
    }
};
