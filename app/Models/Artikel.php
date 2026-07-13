<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';

    protected $fillable = [
        'judul', 'slug', 'konten', 'image_id', 'kategori_id',
        'penulis', 'durasi_baca', 'status', 'tanggal_terbit'
    ];

    protected $casts = [
        'tanggal_terbit' => 'date',
    ];

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}

