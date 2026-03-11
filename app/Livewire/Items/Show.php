<?php

namespace App\Livewire\Items;

use App\Models\Item;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.navigation')]
class Show extends Component
{
    public Item $item;

    public function mount($id)
    {
        $this->item = Item::with('stats')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.items.show');
    }
}
