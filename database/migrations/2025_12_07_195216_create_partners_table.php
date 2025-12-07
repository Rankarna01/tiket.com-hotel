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
    Schema::create('partners', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Contoh: Accor Hotels
        $table->string('slug')->unique();
        $table->string('logo'); // Logo Kecil di Home
        $table->string('banner_image'); // Banner Besar di Detail Page
        $table->text('description')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
