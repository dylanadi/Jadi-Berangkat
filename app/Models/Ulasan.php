<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan';

    protected $fillable = ['bintang', 'pesan', 'gambar_profile', 'image_id', 'nama_user', 'kategori', 'ditampilkan'];

    protected $casts = [
        'ditampilkan' => 'boolean',
    ];

    /**
     * Relasi ke tabel images terpusat (untuk foto profil reviewer).
     */
    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    /**
     * Ambil URL foto profil: utamakan dari tabel images, fallback ke kolom gambar_profile lama.
     */
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image) {
            return $this->image->url();
        }
        if ($this->gambar_profile) {
            return asset('img/' . $this->gambar_profile);
        }
        return null;
    }
}
