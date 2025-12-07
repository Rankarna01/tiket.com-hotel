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
    Schema::create('promo_hotel', function (Blueprint $table) {
        $table->id();
        $table->foreignId('promo_id')->constrained('promos')->cascadeOnDelete();
        $table->foreignId('hotel_id')->constrained('hotels')->cascadeOnDelete();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::dropIfExists('promo_hotel');
}
};
