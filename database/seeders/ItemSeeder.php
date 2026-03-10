<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
                'name' => 'Excalibur',
                'description' => 'A legendary sword with immense power',
                'type' => 'weapon',
                'rarity' => 'legendary',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Steel Armor',
                'description' => 'Heavy protective armor made of steel',
                'type' => 'armor',
                'rarity' => 'common',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Magic Staff',
                'description' => 'A staff infused with ancient magic',
                'type' => 'weapon',
                'rarity' => 'rare',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Health Potion',
                'description' => 'Restores 50 HP instantly',
                'type' => 'consumable',
                'rarity' => 'common',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dragon Shield',
                'description' => 'Shield forged from dragon scales',
                'type' => 'armor',
                'rarity' => 'epic',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Shadow Dagger',
                'description' => 'A dagger that strikes from the shadows',
                'type' => 'weapon',
                'rarity' => 'rare',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mystic Amulet',
                'description' => 'Increases magical power significantly',
                'type' => 'accessory',
                'rarity' => 'epic',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Speed Boots',
                'description' => 'Enhances movement speed',
                'type' => 'armor',
                'rarity' => 'uncommon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
