<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;
use RuntimeException;

class InventoryHistory extends Model
{
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

    public function cancel(): BelongsTo
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

    /**
     * Create a new transaction for cancelling a transaction
     *
     * @throws RuntimeException When transaction is canceled it cannot be completed
     */
    public function cancelling()
    {
        if ($this->cannotCancelling()) {
            throw new RuntimeException(__('Cannot cancel because it already canceled'));
        }

        $replicate = $this->replicate();

        $cancelInventoryHistory = $replicate->item->plusminus(
            $replicate->quantity * -1,
            $replicate->historyable_type,
            $replicate->historyable_id,
            $this->id
        );

        $this->cancel_id = $cancelInventoryHistory->id;

        $this->save();
    }

    public function canCancelling(): bool
    {
        return self::where('cancel_id', $this->id)->doesntExist();
    }

    public function cannotCancelling(): bool
    {
        return ! $this->canCancelling();
    }
}
