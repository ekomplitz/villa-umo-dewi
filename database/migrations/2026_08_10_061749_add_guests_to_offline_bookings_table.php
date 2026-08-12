<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('offline_bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('offline_bookings', 'guests')) {
                $table->json('guests')->nullable()->after('notes');
            }
        });
    }

    public function down(): void
    {
        Schema::table('offline_bookings', function (Blueprint $table) {
            $table->dropColumn('guests');
        });
    }
};