<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';

    protected $fillable = [
        'judul', 'slug', 'konten', 'gambar', 'kategori',
        'penulis', 'durasi_baca', 'status', 'tanggal_terbit'
    ];

    protected $casts = [
        'tanggal_terbit' => 'date',
    ];
}
