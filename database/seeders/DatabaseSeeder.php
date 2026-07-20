<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@villamodewi.com'], // Ganti username dengan email
            [
                'name' => 'adminumo',
                'email' => 'admin@villamodewi.com',
                'password' => Hash::make('100%Tabanan'),
                // 'role' => 'admin', // Hapus jika tidak ada kolom role
            ]
        );
    }
}