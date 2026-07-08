<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectKisah extends Model
{
    protected $table = 'sect_kisah';

    protected $fillable = [
        'badge', 'judul',
        'deskripsi_1', 'deskripsi_2', 'highlight_text',
        'gambar_1_id', 'gambar_2_id', 'badge_text',
    ];

    public function gambar1()
    {
        return $this->belongsTo(Image::class, 'gambar_1_id');
    }

    public function gambar2()
    {
        return $this->belongsTo(Image::class, 'gambar_2_id');
    }
}
