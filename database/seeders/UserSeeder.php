<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus user lama
        User::where('email', 'admin@villamodewi.com')->delete();

        // Buat user admin
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
        ]);

        // Buat user adminumo
        User::create([
            'name' => 'Admin Umo',
            'username' => 'adminumo',
            'email' => 'admin@villamodewi.com',
            'password' => Hash::make('Tabanan2025'),
        ]);
    }
}