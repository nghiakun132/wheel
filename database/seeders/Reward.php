<?php

namespace Database\Seeders;

use App\Models\Reward as ModelsReward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Reward extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsReward::insert([[
            'shop_name' => 'Shop 1',
            'reward_name' => 'PIN',
            'reward_quantity' => 10,
            'images' => 'images/PIN.png',
        ], [
            'shop_name' => 'Shop 1',
            'reward_name' => 'Keychain',
            'reward_quantity' => 10,
            'images' => 'images/Keychain.png',
        ], [
            'shop_name' => 'Shop 1',
            'reward_name' => 'STICKER',
            'reward_quantity' => 10,
            'images' => 'images/STICKER.png',
        ], [
            'shop_name' => 'Shop 1',
            'reward_name' => 'Voucher',
            'reward_quantity' => 10,
            'images' => 'images/Voucher.png',
        ]]);
    }
}
