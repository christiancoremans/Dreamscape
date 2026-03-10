<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProfileSeeder::class,
            ItemSeeder::class,
            ItemStatSeeder::class,
            InventorySeeder::class,
            TradeSeeder::class,
            TradeItemSeeder::class,
            NotificationSeeder::class,
        ]);
    }
}
