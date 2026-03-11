<?php

namespace App\Livewire\Inventory;

use App\Models\Inventory;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.navigation')]
class Index extends Component
{
    public $search = '';
    public $typeFilter = '';
    public $sortBy = 'name';
    public $minPower = 0;
    public $maxPower = 100;
    public $minSpeed = 0;
    public $maxSpeed = 100;
    public $minDurability = 0;
    public $maxDurability = 100;
    public $minMagic = 0;
    public $maxMagic = 100;

    protected $queryString = [
        'search' => ['except' => ''],
        'typeFilter' => ['except' => ''],
        'sortBy' => ['except' => 'name'],
    ];

    public function render()
    {
        $inventories = Inventory::query()
            ->where('user_id', auth()->id())
            ->with(['item.stats'])
            ->when($this->search, function ($query) {
                $query->whereHas('item', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->typeFilter, function ($query) {
                $query->whereHas('item', function ($q) {
                    $q->where('type', $this->typeFilter);
                });
            })
            ->when($this->minPower > 0 || $this->maxPower < 100, function ($query) {
                $query->whereHas('item.stats', function ($q) {
                    $q->whereBetween('power', [$this->minPower, $this->maxPower]);
                });
            })
            ->when($this->minSpeed > 0 || $this->maxSpeed < 100, function ($query) {
                $query->whereHas('item.stats', function ($q) {
                    $q->whereBetween('speed', [$this->minSpeed, $this->maxSpeed]);
                });
            })
            ->when($this->minDurability > 0 || $this->maxDurability < 100, function ($query) {
                $query->whereHas('item.stats', function ($q) {
                    $q->whereBetween('durability', [$this->minDurability, $this->maxDurability]);
                });
            })
            ->when($this->minMagic > 0 || $this->maxMagic < 100, function ($query) {
                $query->whereHas('item.stats', function ($q) {
                    $q->whereBetween('magic', [$this->minMagic, $this->maxMagic]);
                });
            })
            ->when($this->sortBy === 'name', function ($query) {
                $query->join('items', 'inventories.item_id', '=', 'items.id')
                    ->orderBy('items.name')
                    ->select('inventories.*');
            })
            ->when($this->sortBy === 'type', function ($query) {
                $query->join('items', 'inventories.item_id', '=', 'items.id')
                    ->orderBy('items.type')
                    ->select('inventories.*');
            })
            ->when($this->sortBy === 'acquired', function ($query) {
                $query->orderBy('acquired_at', 'desc');
            })
            ->paginate(12);

        return view('livewire.inventory.index', [
            'inventories' => $inventories,
        ]);
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->typeFilter = '';
        $this->sortBy = 'name';
        $this->minPower = 0;
        $this->maxPower = 100;
        $this->minSpeed = 0;
        $this->maxSpeed = 100;
        $this->minDurability = 0;
        $this->maxDurability = 100;
        $this->minMagic = 0;
        $this->maxMagic = 100;
    }
}
