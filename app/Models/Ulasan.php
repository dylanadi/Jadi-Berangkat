<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan';

    protected $fillable = ['bintang', 'pesan', 'image_id', 'nama_user', 'kategori', 'ditampilkan'];

    protected $casts = [
        'ditampilkan' => 'boolean',
    ];

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }
}
