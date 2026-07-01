<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offline_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email')->nullable();
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('duration');
            $table->text('selected_bungalows');
            $table->integer('total_price');
            $table->text('notes')->nullable();
            $table->enum('payment_status', ['pending', 'paid', 'partial'])->default('pending');
            $table->enum('status', ['confirmed', 'pending', 'cancelled'])->default('pending');
            $table->string('booked_by')->nullable(); // nama admin yang booking
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offline_bookings');
    }
};