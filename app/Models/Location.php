<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    public function up()
{
    Schema::create('locations', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Contoh: Bali, Bandung, Jakarta
        $table->string('slug')->unique();
        $table->string('image')->nullable(); // Foto thumbnail wilayah (opsional)
        $table->timestamps();
    });
    
}

use HasFactory;
    protected $guarded = [];

    // Relasi: Satu Wilayah punya banyak Hotel
    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
}
