<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Ubah kolom booking_date agar nullable
            $table->date('booking_date')->nullable()->change();
            
            // Ubah kolom rooms, guests, package agar nullable
            $table->integer('rooms')->nullable()->change();
            $table->integer('guests')->nullable()->change();
            $table->string('package')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->date('booking_date')->nullable(false)->change();
            $table->integer('rooms')->nullable(false)->change();
            $table->integer('guests')->nullable(false)->change();
            $table->string('package')->nullable(false)->change();
        });
    }
};