<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectNilai extends Model
{
    protected $table = 'sect_nilai';

    protected $fillable = ['badge', 'judul'];

    public function cardNilai()
    {
        return $this->hasMany(CardNilai::class, 'sect_nilai_id');
    }
}
