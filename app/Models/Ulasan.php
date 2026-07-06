<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan';

    protected $fillable = ['bintang', 'pesan', 'gambar_profile', 'nama_user', 'kategori', 'ditampilkan'];

    protected $casts = [
        'ditampilkan' => 'boolean',
    ];
}
