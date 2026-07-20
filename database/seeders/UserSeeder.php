<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus semua user yang akan dibuat ulang
        User::where('email', 'admin@villamodewi.com')->delete();
        User::where('email', 'admin@admin.com')->delete();
        User::where('username', 'adminumo')->delete();
        User::where('username', 'admin')->delete();

        // Buat user adminumo
        User::create([
            'name' => 'Admin Umo',
            'username' => 'adminumo',
            'email' => 'admin@villamodewi.com',
            'password' => Hash::make('100%Tabanan'),
        ]);

        // Buat user admin
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
        ]);
    }
}