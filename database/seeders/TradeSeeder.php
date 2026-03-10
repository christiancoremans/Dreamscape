<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trades')->insert([
            [
                'sender_id' => 2, // Player 1
                'receiver_id' => 3, // Player 2
                'status' => 'completed',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(4),
            ],
            [
                'sender_id' => 3, // Player 2
                'receiver_id' => 4, // Trader Joe
                'status' => 'pending',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'sender_id' => 4, // Trader Joe
                'receiver_id' => 5, // Merchant
                'status' => 'rejected',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(2),
            ],
            [
                'sender_id' => 5, // Merchant
                'receiver_id' => 2, // Player 1
                'status' => 'pending',
                'created_at' => now()->subHours(12),
                'updated_at' => now()->subHours(12),
            ],
        ]);
    }
}
