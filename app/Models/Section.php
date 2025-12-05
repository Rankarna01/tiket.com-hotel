<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded = [];

    protected $casts = [
        'locations' => 'array', // Simpan chips lokasi sebagai JSON ["Bogor", "Bali"]
    ];

    // Relasi: Satu Section punya banyak Hotel
    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'section_hotel')
                    ->withPivot('tag'); // Kita ambil data 'tag' dari tabel pivot
    }
}
