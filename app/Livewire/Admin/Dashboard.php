<?php

namespace App\Livewire\Admin;

use App\Models\Item;
use App\Models\Trade;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.navigation')]
class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'total_users' => User::count(),
            'total_items' => Item::count(),
            'total_trades' => Trade::count(),
            'pending_trades' => Trade::where('status', 'pending')->count(),
            'admin_users' => User::where('role', 'admin')->count(),
            'player_users' => User::where('role', 'player')->count(),
            'items_by_type' => Item::selectRaw('type, count(*) as count')
                ->groupBy('type')
                ->pluck('count', 'type'),
            'items_by_rarity' => Item::selectRaw('rarity, count(*) as count')
                ->groupBy('rarity')
                ->pluck('count', 'rarity'),
        ];

        return view('livewire.admin.dashboard', compact('stats'));
    }
}
