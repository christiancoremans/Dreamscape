<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('inventories')->insert([
            // Player 1 inventory
            [
                'user_id' => 2,
                'item_id' => 1, // Excalibur
                'acquired_at' => now()->subDays(10),
            ],
            [
                'user_id' => 2,
                'item_id' => 2, // Steel Armor
                'acquired_at' => now()->subDays(5),
            ],
            [
                'user_id' => 2,
                'item_id' => 4, // Health Potion
                'acquired_at' => now()->subDays(2),
            ],
            // Player 2 inventory
            [
                'user_id' => 3,
                'item_id' => 3, // Magic Staff
                'acquired_at' => now()->subDays(8),
            ],
            [
                'user_id' => 3,
                'item_id' => 6, // Shadow Dagger
                'acquired_at' => now()->subDays(4),
            ],
            [
                'user_id' => 3,
                'item_id' => 7, // Mystic Amulet
                'acquired_at' => now()->subDays(3),
            ],
            // Trader Joe inventory
            [
                'user_id' => 4,
                'item_id' => 4, // Health Potion
                'acquired_at' => now()->subDays(1),
            ],
            [
                'user_id' => 4,
                'item_id' => 8, // Speed Boots
                'acquired_at' => now()->subDays(6),
            ],
            // Merchant inventory
            [
                'user_id' => 5,
                'item_id' => 5, // Dragon Shield
                'acquired_at' => now()->subDays(15),
            ],
            [
                'user_id' => 5,
                'item_id' => 4, // Health Potion
                'acquired_at' => now()->subDays(7),
            ],
        ]);
    }
}
