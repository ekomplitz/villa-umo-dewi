<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Cek apakah kolom ada sebelum dihapus
            if (Schema::hasColumn('bookings', 'booking_date')) {
                $table->dropColumn('booking_date');
            }
            if (Schema::hasColumn('bookings', 'rooms')) {
                $table->dropColumn('rooms');
            }
            if (Schema::hasColumn('bookings', 'guests')) {
                $table->dropColumn('guests');
            }
            if (Schema::hasColumn('bookings', 'package')) {
                $table->dropColumn('package');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->date('booking_date')->nullable();
            $table->integer('rooms')->nullable();
            $table->integer('guests')->nullable();
            $table->string('package')->nullable();
        });
    }
};