<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnInclude extends Model
{
    use HasFactory;

    protected $table = 'un_include';

    protected $fillable = ['destinasi_id', 'tidak_termasuk'];

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }
}
