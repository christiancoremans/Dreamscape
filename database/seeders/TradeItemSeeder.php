<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TradeItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trade_items')->insert([
            // Trade 1 items (Player 1 -> Player 2)
            [
                'trade_id' => 1,
                'item_id' => 2, // Steel Armor
            ],
            [
                'trade_id' => 1,
                'item_id' => 4, // Health Potion
            ],
            // Trade 2 items (Player 2 -> Trader Joe)
            [
                'trade_id' => 2,
                'item_id' => 6, // Shadow Dagger
            ],
            // Trade 3 items (Trader Joe -> Merchant)
            [
                'trade_id' => 3,
                'item_id' => 8, // Speed Boots
            ],
            // Trade 4 items (Merchant -> Player 1)
            [
                'trade_id' => 4,
                'item_id' => 5, // Dragon Shield
            ],
            [
                'trade_id' => 4,
                'item_id' => 4, // Health Potion
            ],
        ]);
    }
}
