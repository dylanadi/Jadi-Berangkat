<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectHomeHero extends Model
{
    protected $table = 'sect_home_hero';

    protected $fillable = [
        'badge', 'judul', 'deskripsi',
        'btn_booking', 'btn_destinasi',
        'stat_destinasi_angka', 'stat_destinasi_label',
        'stat_armada_angka', 'stat_armada_label',
        'stat_rating_angka', 'stat_rating_label',
        'gambar_latar_id', 'embed_video',
    ];

    public function gambarLatar()
    {
        return $this->belongsTo(Image::class, 'gambar_latar_id');
    }
}
