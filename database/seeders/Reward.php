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
        ModelsReward::insert([
            [
                'shop_name' => 'Shop 1',
                'reward_name' => 'Pin',
                'reward_quantity' => 10,
                'images' => 'image/pin.png',
            ],
            [
                'shop_name' => 'Shop 1',
                'reward_name' => 'Voucher',
                'reward_quantity' => 10,
                'images' => 'image/voucher.png',
            ],
            [
                'shop_name' => 'Shop 1',
                'reward_name' => 'Móc khóa',
                'reward_quantity' => 10,
                'images' => 'image/mockhoa.png',
            ],
            [
                'shop_name' => 'Shop 1',
                'reward_name' => 'Sticker',
                'reward_quantity' => 10,
                'images' => 'image/sticker.png',
            ],
        ]);
    }
}
