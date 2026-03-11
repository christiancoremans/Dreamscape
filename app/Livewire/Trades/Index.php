<?php

namespace App\Livewire\Trades;

use App\Models\Trade;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.navigation')]
class Index extends Component
{
    use WithPagination;

    public $filter = 'all'; // all, sent, received, pending

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function render()
    {
        $query = Trade::query()
            ->with(['sender', 'receiver', 'tradeItems.item.stats', 'tradeItems.offeredBy']);

        // Filter by user involvement
        $query->where(function ($q) {
            $q->where('sender_id', auth()->id())
              ->orWhere('receiver_id', auth()->id());
        });

        // Apply additional filters
        switch ($this->filter) {
            case 'sent':
                $query->where('sender_id', auth()->id());
                break;
            case 'received':
                $query->where('receiver_id', auth()->id());
                break;
            case 'pending':
                $query->where('status', 'pending')
                      ->where('receiver_id', auth()->id());
                break;
        }

        $trades = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.trades.index', [
            'trades' => $trades,
        ]);
    }
}
