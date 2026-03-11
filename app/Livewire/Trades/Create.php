<?php

namespace App\Livewire\Trades;

use App\Models\Trade;
use App\Models\TradeItem;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.navigation')]
class Create extends Component
{
    public $receiverId = '';
    public $selectedItems = [];
    public $users = [];
    public $myItems = [];

    public function mount()
    {
        // Get all users except current user
        $this->users = User::where('id', '!=', auth()->id())
            ->orderBy('username')
            ->get();

        // Get current user's inventory with item details
        $this->myItems = auth()->user()
            ->inventories()
            ->with(['item.stats'])
            ->get();
    }

    public function toggleItem($inventoryId)
    {
        if (in_array($inventoryId, $this->selectedItems)) {
            $this->selectedItems = array_values(array_diff($this->selectedItems, [$inventoryId]));
        } else {
            $this->selectedItems[] = $inventoryId;
        }
    }

    public function createTrade()
    {
        $this->validate([
            'receiverId' => 'required|exists:users,id',
            'selectedItems' => 'required|array|min:1',
        ], [
            'receiverId.required' => 'Please select a player to trade with.',
            'receiverId.exists' => 'Selected player does not exist.',
            'selectedItems.required' => 'Please select at least one item to offer.',
            'selectedItems.min' => 'Please select at least one item to offer.',
        ]);

        // Create the trade
        $trade = Trade::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiverId,
            'status' => 'pending',
        ]);

        // Add selected items to the trade
        foreach ($this->selectedItems as $inventoryId) {
            $inventory = auth()->user()->inventories()->find($inventoryId);
            
            if ($inventory) {
                TradeItem::create([
                    'trade_id' => $trade->id,
                    'item_id' => $inventory->item_id,
                    'offered_by_user_id' => auth()->id(),
                ]);
            }
        }

        session()->flash('success', 'Trade request sent successfully!');
        
        return $this->redirect(route('trades.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.trades.create');
    }
}
