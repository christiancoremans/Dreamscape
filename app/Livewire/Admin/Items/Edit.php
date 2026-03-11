<?php

namespace App\Livewire\Admin\Items;

use App\Models\Item;
use App\Models\ItemStat;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.navigation')]
class Edit extends Component
{
    public Item $item;
    
    public $name = '';
    public $description = '';
    public $type = '';
    public $rarity = '';
    public $power = 0;
    public $speed = 0;
    public $durability = 0;
    public $magic = 0;

    public function mount($id)
    {
        $this->item = Item::with('stats')->findOrFail($id);
        
        $this->name = $this->item->name;
        $this->description = $this->item->description ?? '';
        $this->type = $this->item->type;
        $this->rarity = $this->item->rarity;
        
        if ($this->item->stats) {
            $this->power = $this->item->stats->power;
            $this->speed = $this->item->stats->speed;
            $this->durability = $this->item->stats->durability;
            $this->magic = $this->item->stats->magic;
        }
    }

    public function updateItem()
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
            $this->item->update([
                'name' => $this->name,
                'description' => $this->description,
                'type' => $this->type,
                'rarity' => $this->rarity,
            ]);

            ItemStat::updateOrCreate(
                ['item_id' => $this->item->id],
                [
                    'power' => $this->power,
                    'speed' => $this->speed,
                    'durability' => $this->durability,
                    'magic' => $this->magic,
                ]
            );
        });

        session()->flash('success', 'Item updated successfully!');

        return $this->redirect(route('admin.items.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.items.edit');
    }
}
