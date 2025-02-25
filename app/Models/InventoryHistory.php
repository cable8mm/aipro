<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;

class InventoryHistory extends Model
{
    protected $with = ['author', 'item'];

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'type' => 'string',
            'quantity' => 'integer',
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
            $inventoryHistory->author_id = $inventoryHistory->author_id ?? Auth::user()->id ?? null;
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function bySelf(): BelongsTo
    {
        return $this->belongsTo(InventoryHistory::class, 'cancel_id');
    }

    /**
     * Get the parent historyable model (retail_purchase_item, order_shipment and item_manual_warehousing).
     *
     * @see App\Models\RetailPurchaseItem
     * @see App\Models\OrderShipment
     * @see App\Models\ItemManualWarehousing
     */
    public function historyable(): MorphTo
    {
        return $this->morphTo();
    }
}
