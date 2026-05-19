<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Cek apakah kolom sudah ada sebelum menambah
            if (!Schema::hasColumn('bookings', 'check_in')) {
                $table->date('check_in')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('bookings', 'check_out')) {
                $table->date('check_out')->nullable()->after('check_in');
            }
            if (!Schema::hasColumn('bookings', 'duration')) {
                $table->integer('duration')->nullable()->after('check_out');
            }
            if (!Schema::hasColumn('bookings', 'selected_bungalows')) {
                $table->text('selected_bungalows')->nullable()->after('duration');
            }
            if (!Schema::hasColumn('bookings', 'status')) {
                $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending')->after('total_price');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['check_in', 'check_out', 'duration', 'selected_bungalows', 'status']);
        });
    }
};