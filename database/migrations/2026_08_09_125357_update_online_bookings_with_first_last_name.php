<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Tambah first_name dan last_name
            if (!Schema::hasColumn('bookings', 'first_name')) {
                $table->string('first_name')->after('id');
            }
            
            if (!Schema::hasColumn('bookings', 'last_name')) {
                $table->string('last_name')->nullable()->after('first_name');
            }
            
            // Tambah field lain jika belum
            if (!Schema::hasColumn('bookings', 'adults')) {
                $table->integer('adults')->default(1)->after('phone');
            }
            
            if (!Schema::hasColumn('bookings', 'children')) {
                $table->integer('children')->default(0)->after('adults');
            }
            
            if (!Schema::hasColumn('bookings', 'id_type')) {
                $table->enum('id_type', ['ktp', 'passport'])->default('ktp')->after('children');
            }
            
            if (!Schema::hasColumn('bookings', 'id_number')) {
                $table->string('id_number')->nullable()->after('id_type');
            }
            
            // Email jadi nullable
            if (Schema::hasColumn('bookings', 'email')) {
                $table->string('email')->nullable()->change();
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name',
                'adults',
                'children',
                'id_type',
                'id_number'
            ]);
            $table->string('email')->nullable(false)->change();
        });
    }
};