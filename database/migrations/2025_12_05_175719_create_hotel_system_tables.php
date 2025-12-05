<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Tabel Master Locations (Dibuat dulu supaya Hotel bisa connect)
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // 2. Tabel Master Fasilitas
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->default('fa-solid fa-check');
            $table->timestamps();
        });

        // 3. Tabel Hotel
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            // Relasi ke Locations
            $table->foreignId('location_id')->constrained('locations')->cascadeOnDelete();
            
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('city')->nullable(); // Opsional (backup)
            $table->string('address');
            $table->text('description');
            $table->integer('stars')->default(3);
            $table->decimal('price', 15, 2);
            $table->decimal('original_price', 15, 2);
            $table->float('rating', 2, 1)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->json('images')->nullable(); 
            $table->timestamps();
        });

        // 4. Tabel Pivot (Hotel <-> Fasilitas)
        Schema::create('facility_hotel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->cascadeOnDelete();
            $table->foreignId('facility_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('facility_hotel');
        Schema::dropIfExists('hotels');
        Schema::dropIfExists('facilities');
        Schema::dropIfExists('locations');
    }
};