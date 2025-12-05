<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pastikan tabel tidak ada sebelum dibuat (opsional tapi aman)
        Schema::dropIfExists('sections');

        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable(); // <--- KOLOM WAJIB
            $table->string('icon')->default('fa-solid fa-hotel');
            $table->string('theme_color')->default('orange');
            $table->dateTime('end_time')->nullable();
            $table->json('locations')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};