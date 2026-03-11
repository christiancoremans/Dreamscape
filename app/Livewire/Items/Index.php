<?php

namespace App\Livewire\Items;

use App\Models\Item;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.navigation')]
class Index extends Component
{
    public $search = '';
    public $typeFilter = '';
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
    ];

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
            ->when($this->minPower > 0 || $this->maxPower < 100, function ($query) {
                $query->whereHas('stats', function ($q) {
                    $q->whereBetween('power', [$this->minPower, $this->maxPower]);
                });
            })
            ->when($this->minSpeed > 0 || $this->maxSpeed < 100, function ($query) {
                $query->whereHas('stats', function ($q) {
                    $q->whereBetween('speed', [$this->minSpeed, $this->maxSpeed]);
                });
            })
            ->when($this->minDurability > 0 || $this->maxDurability < 100, function ($query) {
                $query->whereHas('stats', function ($q) {
                    $q->whereBetween('durability', [$this->minDurability, $this->maxDurability]);
                });
            })
            ->when($this->minMagic > 0 || $this->maxMagic < 100, function ($query) {
                $query->whereHas('stats', function ($q) {
                    $q->whereBetween('magic', [$this->minMagic, $this->maxMagic]);
                });
            })
            ->orderBy('name')
            ->paginate(12);

        return view('livewire.items.index', [
            'items' => $items,
        ]);
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->typeFilter = '';
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
