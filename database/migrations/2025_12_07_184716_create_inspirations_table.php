<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('inspirations', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->string('image'); // Gambar Thumbnail di Home
        $table->string('banner_image')->nullable(); // Gambar Besar di Detail Page
        $table->text('description'); // Deskripsi paragraf
        $table->string('bottom_image')->nullable(); // Gambar Statis di paling bawah (Opsional/Dinamis)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspirations');
    }
};
