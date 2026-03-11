<?php

namespace App\Livewire\Admin\Items;

use App\Models\Item;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.navigation')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $typeFilter = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingTypeFilter()
    {
        $this->resetPage();
    }

    public function deleteItem($itemId)
    {
        $item = Item::findOrFail($itemId);
        $item->delete();

        session()->flash('success', 'Item deleted successfully!');
    }

    public function render()
    {
        $items = Item::query()
            ->with('stats')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->typeFilter, function ($query) {
                $query->where('type', $this->typeFilter);
            })
            ->orderBy('name')
            ->paginate(15);

        return view('livewire.admin.items.index', [
            'items' => $items,
        ]);
    }
}
