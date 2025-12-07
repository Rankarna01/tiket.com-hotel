<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspiration extends Model
{
    protected $guarded = [];

    // Relasi ke Hotel (Rekomendasi)
    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'inspiration_hotel');
    }
}
