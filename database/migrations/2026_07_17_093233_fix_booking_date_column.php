<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Cek apakah kolom booking_date ada
            if (!Schema::hasColumn('bookings', 'booking_date')) {
                $table->date('booking_date')->nullable()->after('created_at');
            }
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('booking_date');
        });
    }
};