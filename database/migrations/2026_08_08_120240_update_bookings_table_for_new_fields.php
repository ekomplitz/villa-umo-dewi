<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Ubah name jadi first_name dan last_name
            $table->dropColumn('name');
            $table->string('first_name')->after('id');
            $table->string('last_name')->nullable()->after('first_name');
            
            // Tambah field baru
            $table->integer('adults')->default(1)->after('phone');
            $table->integer('children')->default(0)->after('adults');
            $table->enum('id_type', ['ktp', 'passport'])->default('ktp')->after('children');
            $table->string('id_number')->nullable()->after('id_type');
            
            // Email jadi nullable (opsional)
            $table->string('email')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->dropColumn(['first_name', 'last_name', 'adults', 'children', 'id_type', 'id_number']);
            $table->string('email')->nullable(false)->change();
        });
    }
};