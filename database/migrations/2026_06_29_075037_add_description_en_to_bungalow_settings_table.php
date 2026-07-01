<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bungalow_settings', function (Blueprint $table) {
            // Cek apakah kolom description_en sudah ada
            if (!Schema::hasColumn('bungalow_settings', 'description_en')) {
                $table->text('description_en')->nullable()->after('description_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bungalow_settings', function (Blueprint $table) {
            if (Schema::hasColumn('bungalow_settings', 'description_en')) {
                $table->dropColumn('description_en');
            }
        });
    }
};