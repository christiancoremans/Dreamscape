<?php

namespace App\Livewire\Admin\Inventory;

use App\Models\Inventory;
use App\Models\Item;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.navigation')]
class Assign extends Component
{
    public $userId = '';
    public $itemId = '';

    public function assignItem()
    {
        $this->validate([
            'userId' => 'required|exists:users,id',
            'itemId' => 'required|exists:items,id',
        ], [
            'userId.required' => 'Please select a player.',
            'itemId.required' => 'Please select an item.',
        ]);

        // Check if user already has this item
        $existing = Inventory::where('user_id', $this->userId)
            ->where('item_id', $this->itemId)
            ->exists();

        if ($existing) {
            session()->flash('error', 'Player already has this item in their inventory.');
            return;
        }

        Inventory::create([
            'user_id' => $this->userId,
            'item_id' => $this->itemId,
            'acquired_at' => now(),
        ]);

        session()->flash('success', 'Item assigned to player successfully!');

        $this->reset(['userId', 'itemId']);
    }

    public function render()
    {
        return view('livewire.admin.inventory.assign', [
            'users' => User::where('role', 'player')->orderBy('username')->get(),
            'items' => Item::with('stats')->orderBy('name')->get(),
        ]);
    }
}
