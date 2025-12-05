<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // PERHATIKAN: Ini membuat tabel 'section_hotel', BUKAN 'sections'
        Schema::create('section_hotel', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel sections
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();
            
            // Relasi ke tabel hotels
            $table->foreignId('hotel_id')->constrained('hotels')->cascadeOnDelete();
            
            // Tag tambahan, misal: "Top Hotel", "Great Offer"
            $table->string('tag')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_hotel');
    }
};