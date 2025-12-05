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
    Schema::create('promos', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Judul Promo
        $table->string('slug')->unique(); // Untuk URL SEO friendly
        $table->string('image'); // Gambar Banner Utama
        $table->string('promo_code')->nullable(); // Kode Promo (misal: TIKETNEW)
        $table->string('discount_text')->nullable(); // Teks Diskon (misal: "Diskon s.d. 1jt")
        $table->text('description')->nullable(); // Deskripsi singkat
        $table->longText('terms')->nullable(); // Syarat & Ketentuan (Simpan poin-poinnya)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
