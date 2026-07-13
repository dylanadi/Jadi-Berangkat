<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectGaleriAbout extends Model
{
    protected $table = 'sect_galeri_about';

    protected $fillable = ['label', 'judul', 'tombol_teks'];

    public function items()
    {
        return $this->hasMany(GaleriItemAbout::class, 'sect_galeri_about_id');
    }
}
