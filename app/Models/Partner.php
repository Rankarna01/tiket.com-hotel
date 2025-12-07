<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $guarded = [];

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
}
