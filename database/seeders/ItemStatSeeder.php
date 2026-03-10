<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemStatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('item_stats')->insert([
            [
                'item_id' => 1, // Excalibur
                'power' => 95,
                'speed' => 70,
                'durability' => 90,
                'magic' => 50,
            ],
            [
                'item_id' => 2, // Steel Armor
                'power' => 10,
                'speed' => 30,
                'durability' => 80,
                'magic' => 0,
            ],
            [
                'item_id' => 3, // Magic Staff
                'power' => 40,
                'speed' => 50,
                'durability' => 60,
                'magic' => 95,
            ],
            [
                'item_id' => 4, // Health Potion
                'power' => 0,
                'speed' => 0,
                'durability' => 0,
                'magic' => 25,
            ],
            [
                'item_id' => 5, // Dragon Shield
                'power' => 30,
                'speed' => 40,
                'durability' => 95,
                'magic' => 60,
            ],
            [
                'item_id' => 6, // Shadow Dagger
                'power' => 75,
                'speed' => 90,
                'durability' => 55,
                'magic' => 30,
            ],
            [
                'item_id' => 7, // Mystic Amulet
                'power' => 20,
                'speed' => 60,
                'durability' => 40,
                'magic' => 85,
            ],
            [
                'item_id' => 8, // Speed Boots
                'power' => 5,
                'speed' => 85,
                'durability' => 50,
                'magic' => 15,
            ],
        ]);
    }
}
