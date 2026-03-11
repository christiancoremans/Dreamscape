<?php

namespace App\Livewire\Admin;

use App\Models\Inventory;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.navigation')]
class Statistics extends Component
{
    public function render()
    {
        $stats = [
            // Items per type with player counts
            'items_per_type' => Item::selectRaw('type, count(*) as item_count')
                ->groupBy('type')
                ->get()
                ->map(function ($typeData) {
                    $typeData->player_count = Inventory::whereHas('item', function ($q) use ($typeData) {
                        $q->where('type', $typeData->type);
                    })
                    ->distinct('user_id')
                    ->count('user_id');
                    
                    $typeData->total_owned = Inventory::whereHas('item', function ($q) use ($typeData) {
                        $q->where('type', $typeData->type);
                    })->count();
                    
                    return $typeData;
                }),
                
            // Most owned items
            'most_owned_items' => Item::select('items.*', DB::raw('count(inventories.id) as ownership_count'))
                ->leftJoin('inventories', 'items.id', '=', 'inventories.item_id')
                ->groupBy('items.id')
                ->orderByDesc('ownership_count')
                ->limit(10)
                ->get(),
                
            // Items distribution by rarity
            'rarity_distribution' => Item::selectRaw('rarity, count(*) as count')
                ->groupBy('rarity')
                ->get(),
                
            // Average stats by type
            'avg_stats_by_type' => Item::select('items.type')
                ->selectRaw('AVG(item_stats.power) as avg_power')
                ->selectRaw('AVG(item_stats.speed) as avg_speed')
                ->selectRaw('AVG(item_stats.durability) as avg_durability')
                ->selectRaw('AVG(item_stats.magic) as avg_magic')
                ->leftJoin('item_stats', 'items.id', '=', 'item_stats.item_id')
                ->groupBy('items.type')
                ->get(),
                
            // Players with most items
            'top_collectors' => User::select('users.*', DB::raw('count(inventories.id) as item_count'))
                ->leftJoin('inventories', 'users.id', '=', 'inventories.user_id')
                ->where('users.role', 'player')
                ->groupBy('users.id')
                ->orderByDesc('item_count')
                ->limit(10)
                ->get(),
        ];

        return view('livewire.admin.statistics', compact('stats'));
    }
}
