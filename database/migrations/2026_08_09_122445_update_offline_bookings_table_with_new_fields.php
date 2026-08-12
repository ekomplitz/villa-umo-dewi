<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('offline_bookings', function (Blueprint $table) {
            // Hapus kolom customer_name
            if (Schema::hasColumn('offline_bookings', 'customer_name')) {
                $table->dropColumn('customer_name');
            }
            
            // Tambah kolom baru
            if (!Schema::hasColumn('offline_bookings', 'first_name')) {
                $table->string('first_name')->after('id');
            }
            
            if (!Schema::hasColumn('offline_bookings', 'last_name')) {
                $table->string('last_name')->nullable()->after('first_name');
            }
            
            if (!Schema::hasColumn('offline_bookings', 'country_code')) {
                $table->string('country_code')->default('+62')->after('customer_phone');
            }
            
            if (!Schema::hasColumn('offline_bookings', 'adults')) {
                $table->integer('adults')->default(1)->after('country_code');
            }
            
            if (!Schema::hasColumn('offline_bookings', 'children')) {
                $table->integer('children')->default(0)->after('adults');
            }
            
            if (!Schema::hasColumn('offline_bookings', 'id_type')) {
                $table->enum('id_type', ['ktp', 'passport'])->default('ktp')->after('children');
            }
            
            if (!Schema::hasColumn('offline_bookings', 'id_number')) {
                $table->string('id_number')->nullable()->after('id_type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('offline_bookings', function (Blueprint $table) {
            // Hapus kolom baru
            $table->dropColumn([
                'first_name',
                'last_name',
                'country_code',
                'adults',
                'children',
                'id_type',
                'id_number'
            ]);
            
            // Kembalikan customer_name
            if (!Schema::hasColumn('offline_bookings', 'customer_name')) {
                $table->string('customer_name')->after('id');
            }
        });
    }
};