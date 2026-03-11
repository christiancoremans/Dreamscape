<?php

namespace App\Livewire\Admin\Items;

use App\Models\Item;
use App\Models\ItemStat;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.navigation')]
class Create extends Component
{
    public $name = '';
    public $description = '';
    public $type = 'weapon';
    public $rarity = 'common';
    public $power = 50;
    public $speed = 50;
    public $durability = 50;
    public $magic = 50;

    public function createItem()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:weapon,armor,consumable,accessory',
            'rarity' => 'required|in:common,uncommon,rare,epic,legendary',
            'power' => 'required|integer|min:0|max:100',
            'speed' => 'required|integer|min:0|max:100',
            'durability' => 'required|integer|min:0|max:100',
            'magic' => 'required|integer|min:0|max:100',
        ], [
            'name.required' => 'Item name is required.',
            'power.min' => 'Power must be between 0 and 100.',
            'power.max' => 'Power must be between 0 and 100.',
            'speed.min' => 'Speed must be between 0 and 100.',
            'speed.max' => 'Speed must be between 0 and 100.',
            'durability.min' => 'Durability must be between 0 and 100.',
            'durability.max' => 'Durability must be between 0 and 100.',
            'magic.min' => 'Magic must be between 0 and 100.',
            'magic.max' => 'Magic must be between 0 and 100.',
        ]);

        DB::transaction(function () {
            $item = Item::create([
                'name' => $this->name,
                'description' => $this->description,
                'type' => $this->type,
                'rarity' => $this->rarity,
            ]);

            ItemStat::create([
                'item_id' => $item->id,
                'power' => $this->power,
                'speed' => $this->speed,
                'durability' => $this->durability,
                'magic' => $this->magic,
            ]);
        });

        session()->flash('success', 'Item created successfully!');

        return $this->redirect(route('admin.items.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.items.create');
    }
}
