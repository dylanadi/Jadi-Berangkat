<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardNilai extends Model
{
    protected $table = 'card_nilai';

    protected $fillable = ['sect_nilai_id', 'icon', 'judul', 'deskripsi', 'urutan'];

    public function sectNilai()
    {
        return $this->belongsTo(SectNilai::class, 'sect_nilai_id');
    }
}
