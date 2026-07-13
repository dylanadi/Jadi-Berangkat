<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanHalamanDepan extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_halaman_depan';

    protected $fillable = ['key', 'value', 'tipe'];
}
