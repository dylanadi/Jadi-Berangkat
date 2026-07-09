<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectHomePenawaran extends Model
{
    protected $table = 'sect_home_penawaran';

    protected $fillable = [
        'eyebrow', 'judul', 'deskripsi',
    ];
}
