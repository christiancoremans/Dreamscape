<?php

namespace App\Livewire\Trades;

use App\Models\Inventory;
use App\Models\Trade;
use App\Models\TradeItem;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.navigation')]
class Show extends Component
{
    public Trade $trade;
    public $selectedItems = []; // Items the receiver wants to offer back

    public function mount($id)
    {
        $this->trade = Trade::with([
            'sender',
            'receiver',
            'tradeItems.item.stats',
            'tradeItems.offeredBy'
        ])->findOrFail($id);

        // Ensure user is part of this trade
        if ($this->trade->sender_id !== auth()->id() && $this->trade->receiver_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this trade.');
        }
    }

    public function toggleItem($inventoryId)
    {
        // Only receiver can add items to counter-offer
        if ($this->trade->receiver_id !== auth()->id() || $this->trade->status !== 'pending') {
            return;
        }

        if (in_array($inventoryId, $this->selectedItems)) {
            $this->selectedItems = array_values(array_diff($this->selectedItems, [$inventoryId]));
        } else {
            $this->selectedItems[] = $inventoryId;
        }
    }

    public function acceptTrade()
    {
        // Only receiver can accept
        if ($this->trade->receiver_id !== auth()->id()) {
            session()->flash('error', 'Only the receiver can accept this trade.');
            return;
        }

        if ($this->trade->status !== 'pending') {
            session()->flash('error', 'This trade has already been processed.');
            return;
        }

        DB::transaction(function () {
            // If receiver selected items to offer back, add them to trade
            if (count($this->selectedItems) > 0) {
                foreach ($this->selectedItems as $inventoryId) {
                    $inventory = auth()->user()->inventories()->find($inventoryId);
                    
                    if ($inventory) {
                        TradeItem::create([
                            'trade_id' => $this->trade->id,
                            'item_id' => $inventory->item_id,
                            'offered_by_user_id' => auth()->id(),
                        ]);
                    }
                }
                
                // Reload trade items
                $this->trade->load('tradeItems.item');
            }

            // Transfer items
            foreach ($this->trade->tradeItems as $tradeItem) {
                $offeredBy = $tradeItem->offered_by_user_id;
                $receivedBy = $offeredBy === $this->trade->sender_id 
                    ? $this->trade->receiver_id 
                    : $this->trade->sender_id;

                // Remove from original owner's inventory
                Inventory::where('user_id', $offeredBy)
                    ->where('item_id', $tradeItem->item_id)
                    ->first()
                    ?->delete();

                // Add to new owner's inventory
                Inventory::create([
                    'user_id' => $receivedBy,
                    'item_id' => $tradeItem->item_id,
                    'acquired_at' => now(),
                ]);
            }

            // Update trade status
            $this->trade->update(['status' => 'accepted']);
        });

        session()->flash('success', 'Trade accepted! Items have been transferred.');
        
        return $this->redirect(route('trades.index'), navigate: true);
    }

    public function rejectTrade()
    {
        // Only receiver can reject
        if ($this->trade->receiver_id !== auth()->id()) {
            session()->flash('error', 'Only the receiver can reject this trade.');
            return;
        }

        if ($this->trade->status !== 'pending') {
            session()->flash('error', 'This trade has already been processed.');
            return;
        }

        $this->trade->update(['status' => 'rejected']);

        session()->flash('success', 'Trade rejected. Items remain with their original owners.');
        
        return $this->redirect(route('trades.index'), navigate: true);
    }

    public function cancelTrade()
    {
        // Only sender can cancel
        if ($this->trade->sender_id !== auth()->id()) {
            session()->flash('error', 'Only the sender can cancel this trade.');
            return;
        }

        if ($this->trade->status !== 'pending') {
            session()->flash('error', 'This trade has already been processed.');
            return;
        }

        $this->trade->update(['status' => 'cancelled']);

        session()->flash('success', 'Trade cancelled.');
        
        return $this->redirect(route('trades.index'), navigate: true);
    }

    public function getReceiverInventoryProperty()
    {
        if ($this->trade->receiver_id !== auth()->id()) {
            return collect();
        }

        return auth()->user()
            ->inventories()
            ->with(['item.stats'])
            ->get();
    }

    public function render()
    {
        return view('livewire.trades.show');
    }
}
