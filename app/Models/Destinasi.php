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
        'gambar', 'status', 'durasi', 'mood', 'rating', 'label', 'rute', 'jml_ulasan', 'tipe'
    ];

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
