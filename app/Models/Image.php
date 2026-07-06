<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = ['name', 'path', 'alt', 'disk'];

    public function getUrlAttribute()
    {
        if ($this->disk === 'public') {
            return asset('storage/' . $this->path);
        }
        return asset($this->path);
    }

    public static function resolveUrl($imageId)
    {
        if (!$imageId) return null;
        $image = self::find($imageId);
        return $image ? $image->url : null;
    }

    public static function resolvePath($imageId)
    {
        if (!$imageId) return null;
        $image = self::find($imageId);
        return $image ? $image->path : null;
    }
}
