<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Pivot: Menghubungkan Section (Promo) dengan Hotel
        Schema::create('section_hotel', function (Blueprint $table) {
            $table->id();
            // Pastikan tipe data id sama (foreignId otomatis bigint unsigned)
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();
            $table->foreignId('hotel_id')->constrained('hotels')->cascadeOnDelete();
            $table->string('tag')->nullable(); // Contoh: "Top Hotel", "Great Offer"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('section_hotel');
    }
};