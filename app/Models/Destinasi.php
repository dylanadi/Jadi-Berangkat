<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    use HasFactory;

    protected $table = 'destinasi';

    protected $fillable = [
        'kategori_id', 'nama', 'label', 'slug', 'deskripsi', 
        'deskripsi_singkat', 'lokasi', 'rute', 'harga', 
        'image_id', 'status', 'durasi', 'mood', 'rating', 'jml_ulasan', 'tipe'
    ];

    public const KATEGORI = ['Alam', 'Budaya', 'Pantai', 'Kuliner', 'Petualangan', 'Keluarga'];
    public const DURASI = ['1 Hari', '2 Hari 1 Malam', '3 Hari 2 Malam', 'Lebih dari 3 Hari'];
    public const MOOD = ['Santai', 'Romantis', 'Eksplorasi', 'Adrenalin', 'Edukasi'];

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
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

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}

