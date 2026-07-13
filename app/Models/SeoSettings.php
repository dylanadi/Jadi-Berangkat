<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSettings extends Model
{
    use HasFactory;

    protected $table = 'seo_settings';

    protected $fillable = ['key', 'value', 'tipe'];
}
