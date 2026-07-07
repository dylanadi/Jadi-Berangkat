<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'name',   // nama deskriptif gambar
        'path',   // nama file saja, contoh: unsplash_M8drGBgFNZE.png
        'alt',    // alt text untuk aksesibilitas
        'disk',   // disk storage (public/local)
    ];

    /**
     * Kembalikan URL lengkap gambar.
     *
     * Semua gambar seeder ada di public/img/ → asset('img/' . filename)
     * Gambar upload admin di storage → asset('storage/' . path)
     *
     * Deteksi: jika path mengandung '/' (subfolder) → upload admin (storage)
     *          jika path hanya filename → gambar di public/img/
     */
    public function url(): string
    {
        $path = $this->path;

        // Upload admin: path punya subfolder seperti 'destinasi/abc.jpg'
        if (str_contains($path, '/')) {
            return asset('storage/' . $path);
        }

        // Gambar seeder/default: ada di public/img/
        return asset('img/' . $path);
    }
}
