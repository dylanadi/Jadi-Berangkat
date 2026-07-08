<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncludeModel extends Model
{
    use HasFactory;

    protected $table = 'include';

    protected $fillable = ['destinasi_id', 'termasuk'];

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }
}
