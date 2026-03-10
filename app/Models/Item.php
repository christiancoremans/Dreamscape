<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'description',
        'type',
        'rarity',
    ];

    /**
     * Get the item's stats.
     */
    public function stats()
    {
        return $this->hasOne(ItemStat::class);
    }

    /**
     * Get the inventories for the item.
     */
    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    /**
     * Get the trade items for the item.
     */
    public function tradeItems()
    {
        return $this->hasMany(TradeItem::class);
    }
}
