<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaSosial extends Model
{
    use HasFactory;

    protected $table = 'media_sosial';

    protected $fillable = ['platform', 'link', 'nomor', 'ikon', 'aktif'];

    protected $casts = [
        'aktif' => 'boolean',
    ];
}
