<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class InventoryHistory extends Model
{
    use HasFactory;

    protected $with = ['author', 'good'];

    protected function casts(): array
    {
        return [
            'type' => 'string',
            'quantity' => 'integer',
            'price' => 'integer',
            'after_quantity' => 'integer',
            'model' => 'string',
            'attribute' => 'integer',
            'cancel_id' => 'integer',
            'is_success' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (InventoryHistory $inventoryHistory) {
            $inventoryHistory->author_id = $supplier->inventoryHistory ?? Auth::user()->id;
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function good(): BelongsTo
    {
        return $this->belongsTo(Good::class);
    }

    public function bySelf(): BelongsTo
    {
        return $this->belongsTo(InventoryHistory::class, 'cancel_id');
    }
}
