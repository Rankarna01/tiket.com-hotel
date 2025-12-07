<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'images' => 'array', // Otomatis convert JSON ke Array
    ];

    // Relasi ke Fasilitas
    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'facility_hotel');
    }

    // Relasi ke Section (yang sebelumnya)
    public function sections()
    {
        return $this->belongsToMany(Section::class, 'section_hotel');
    }
    // Tambahkan di dalam class Hotel
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function promos()
{
    return $this->belongsToMany(Promo::class, 'promo_hotel');
}

public function partner()
{
    return $this->belongsTo(Partner::class);
}
}
