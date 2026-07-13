<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $fillable = ['kategori_id', 'judul', 'image_id', 'deskripsi', 'slug'];

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}

