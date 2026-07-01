<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bungalow_settings', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // b1, b2, b3, b4
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('price');
            $table->string('image')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bungalow_settings');
    }
};