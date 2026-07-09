<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectHomeFooter extends Model
{
    protected $table = 'sect_home_footer';

    protected $fillable = [
        'judul', 'tentang', 'copyright',
    ];
}
