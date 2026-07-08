<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPerjalanan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_perjalanan';

    protected $fillable = ['destinasi_id', 'judul', 'deskripsi', 'urutan'];

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }
}
