<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // IZINKAN KOLOM INI DIISI
    protected $fillable = [
        'user_id',
        'hotel_id',
        'booking_code',
        'customer_name',
        'customer_email',
        'customer_phone',
        'check_in',
        'check_out',
        'total_room',
        'total_night',
        'total_price',
        'status',
        'snap_token'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Hotel
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}