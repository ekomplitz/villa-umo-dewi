<?php

namespace Database\Seeders;

use App\Models\BungalowSetting;
use Illuminate\Database\Seeder;

class BungalowSettingSeeder extends Seeder
{
    public function run()
    {
        $bungalows = [
            [
                'code' => 'b1',
                'name' => 'Bungalow 1',
                'description_id' => 'Kamar dengan view sawah',
                'description_en' => 'Room with rice field view',
                'price' => 250000,
                'status' => 'active'
            ],
            [
                'code' => 'b2',
                'name' => 'Bungalow 2',
                'description_id' => 'Cocok untuk keluarga',
                'description_en' => 'Perfect for family',
                'price' => 250000,
                'status' => 'active'
            ],
            [
                'code' => 'b3',
                'name' => 'Bungalow 3',
                'description_id' => 'Kamar dengan balkon',
                'description_en' => 'Room with balcony',
                'price' => 500000,
                'status' => 'active'
            ],
            [
                'code' => 'b4',
                'name' => 'Bungalow 4',
                'description_id' => 'Kamar standar nyaman',
                'description_en' => 'Comfortable economy room',
                'price' => 500000,
                'status' => 'active'
            ]
        ];

        foreach ($bungalows as $bungalow) {
            BungalowSetting::create($bungalow);
        }
    }
}