<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeItem extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'trade_id',
        'item_id',
    ];

    /**
     * Get the trade that owns the trade item.
     */
    public function trade()
    {
        return $this->belongsTo(Trade::class);
    }

    /**
     * Get the item in the trade.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
