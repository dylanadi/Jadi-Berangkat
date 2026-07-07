<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';

    protected $fillable = [
        'judul', 'slug', 'konten', 'gambar', 'image_id', 'kategori',
        'penulis', 'durasi_baca', 'status', 'tanggal_terbit'
    ];

    protected $casts = [
        'tanggal_terbit' => 'date',
    ];

    /**
     * Relasi ke tabel images terpusat.
     */
    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    /**
     * Ambil URL gambar: utamakan dari tabel images, fallback ke kolom gambar lama.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return $this->image->url();
        }
        return asset('img/' . ($this->gambar ?? 'unsplash_M8drGBgFNZE.png'));
    }
}
