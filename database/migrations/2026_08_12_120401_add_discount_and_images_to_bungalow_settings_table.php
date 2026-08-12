<?php
// database/migrations/2026_08_12_000000_add_discount_and_images_to_bungalow_settings.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bungalow_settings', function (Blueprint $table) {
            $table->integer('discount_price')->nullable()->after('price');
            $table->json('images')->nullable()->after('image');
        });
    }

    public function down()
    {
        Schema::table('bungalow_settings', function (Blueprint $table) {
            $table->dropColumn(['discount_price', 'images']);
        });
    }
};