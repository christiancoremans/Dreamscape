<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemStat extends Model
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
        'item_id',
        'power',
        'speed',
        'durability',
        'magic',
    ];

    /**
     * Get the item that owns the stats.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
