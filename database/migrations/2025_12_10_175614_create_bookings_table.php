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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        // Relasi
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->foreignId('hotel_id')->constrained()->cascadeOnDelete();
        
        // Data Transaksi
        $table->string('booking_code')->unique(); // Order ID Midtrans
        $table->string('customer_name');
        $table->string('customer_email');
        $table->string('customer_phone');
        
        // Detail Menginap
        $table->date('check_in');
        $table->date('check_out');
        $table->integer('total_room');
        $table->integer('total_night');
        $table->decimal('total_price', 15, 2);
        
        // Status & Payment
        $table->enum('status', ['unpaid', 'paid', 'cancelled', 'expired'])->default('unpaid');
        $table->string('snap_token')->nullable();
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
