<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $guarded = [];

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'facility_hotel');
    }
}
