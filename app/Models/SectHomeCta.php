<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectHomeCta extends Model
{
    protected $table = 'sect_home_cta';

    protected $fillable = [
        'judul', 'deskripsi',
    ];
}
