<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    use HasFactory;

    protected $table = 'destinasi';

    protected $fillable = [
        'kategori', 'nama', 'slug', 'deskripsi', 'deskripsi_singkat', 'lokasi', 'harga',
        'image_id', 'status', 'durasi', 'mood', 'rating', 'label', 'rute', 'jml_ulasan', 'tipe'
    ];

    /**
     * Relasi ke tabel images terpusat.
     */
    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    /**
     * Ambil URL gambar dari tabel images terpusat.
     * Fallback ke gambar default jika image_id belum diset.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return $this->image->url();
        }
        return asset('img/unsplash_M8drGBgFNZE.png');
    }

    public function jadwalPerjalanan()
    {
        return $this->hasMany(JadwalPerjalanan::class);
    }

    public function includes()
    {
        return $this->hasMany(IncludeModel::class, 'destinasi_id');
    }

    public function unIncludes()
    {
        return $this->hasMany(UnInclude::class, 'destinasi_id');
    }
}
