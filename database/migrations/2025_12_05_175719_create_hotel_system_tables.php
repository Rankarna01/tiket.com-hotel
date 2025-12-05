<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Tabel Master Fasilitas
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: WiFi, Kolam Renang
            $table->string('icon')->default('fa-solid fa-check'); // Icon Fontawesome
            $table->timestamps();
        });

        // 2. Tabel Hotel (Update: Images jadi JSON, Facilities dihapus diganti relasi)
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('city');
            $table->string('address');
            $table->text('description');
            $table->integer('stars')->default(3);
            $table->decimal('price', 15, 2);
            $table->decimal('original_price', 15, 2);
            $table->float('rating', 2, 1)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->json('images')->nullable(); // Menyimpan path file: ["hotels/abc.jpg", "hotels/def.jpg"]
            $table->timestamps();
        });

        // 3. Tabel Pivot (Hubungan Hotel <-> Fasilitas)
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
    }
};