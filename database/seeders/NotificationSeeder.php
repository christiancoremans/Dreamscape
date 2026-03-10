<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notifications')->insert([
            [
                'user_id' => 2,
                'trade_id' => 4,
                'message' => 'You have received a new trade offer from Merchant',
                'is_read' => false,
                'created_at' => now()->subHours(12),
            ],
            [
                'user_id' => 3,
                'trade_id' => 1,
                'message' => 'Your trade with Dragon Slayer has been completed',
                'is_read' => true,
                'created_at' => now()->subDays(4),
            ],
            [
                'user_id' => 4,
                'trade_id' => 2,
                'message' => 'Shadow Knight sent you a trade offer',
                'is_read' => false,
                'created_at' => now()->subDays(2),
            ],
            [
                'user_id' => 4,
                'trade_id' => 3,
                'message' => 'Your trade offer to The Merchant was rejected',
                'is_read' => true,
                'created_at' => now()->subDays(2),
            ],
            [
                'user_id' => 5,
                'trade_id' => 3,
                'message' => 'You rejected a trade from Trading Joe',
                'is_read' => true,
                'created_at' => now()->subDays(2),
            ],
            [
                'user_id' => 2,
                'trade_id' => null,
                'message' => 'Welcome to DreamScape! Start your adventure now.',
                'is_read' => true,
                'created_at' => now()->subDays(10),
            ],
        ]);
    }
}
