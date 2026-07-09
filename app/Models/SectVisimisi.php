<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectVisimisi extends Model
{
    protected $table = 'sect_visimisi';

    protected $fillable = [
        'badge', 'judul', 'visi_deskripsi',
    ];

    public function misiItems()
    {
        return $this->hasMany(MisiItem::class, 'sect_visimisi_id');
    }
}
