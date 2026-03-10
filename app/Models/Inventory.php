<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
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
        'user_id',
        'item_id',
        'acquired_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'acquired_at' => 'datetime',
        ];
    }

    /**
     * Get the user that owns the inventory.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the item in the inventory.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
