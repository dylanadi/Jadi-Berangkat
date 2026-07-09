<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MisiItem extends Model
{
    protected $table = 'misi_item';

    protected $fillable = ['sect_visimisi_id', 'nomor', 'deskripsi'];

    public function visimisi()
    {
        return $this->belongsTo(SectVisimisi::class, 'sect_visimisi_id');
    }
}
