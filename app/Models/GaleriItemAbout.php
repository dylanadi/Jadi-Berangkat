<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriItemAbout extends Model
{
    protected $table = 'galeri_item_about';

    protected $fillable = [
        'sect_galeri_about_id', 'gambar_id', 'tag',
        'is_video', 'video_url', 'urutan',
    ];

    public function sectGaleriAbout()
    {
        return $this->belongsTo(SectGaleriAbout::class, 'sect_galeri_about_id');
    }

    public function gambar()
    {
        return $this->belongsTo(Image::class, 'gambar_id');
    }
}
