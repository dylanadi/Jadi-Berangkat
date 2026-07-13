<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectAboutHero extends Model
{
    protected $table = 'sect_about_hero';

    protected $fillable = [
        'badge', 'judul', 'konten',
        'stat_1_angka', 'stat_1_label',
        'stat_2_angka', 'stat_2_label',
        'stat_3_angka', 'stat_3_label',
        'stat_4_angka', 'stat_4_label',
        'gambar_id', 'badge_premium', 'caption',
    ];

    public function gambar()
    {
        return $this->belongsTo(Image::class, 'gambar_id');
    }
}
