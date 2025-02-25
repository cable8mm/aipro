<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class RetailPurchaseItem extends Model
{
    /** @use HasFactory<\Database\Factories\RetailPurchaseItemFactory> */
    use HasFactory;

    protected static function booted(): void
    {
        static::saved(function (RetailPurchaseItem $retailPurchaseItem) {
            $retailPurchaseItem->retailPurchase->update([
                'total_price' => $retailPurchaseItem->retailPurchase->getTotalPrice(),
                'item_count' => $retailPurchaseItem->retailPurchase->getItemCount(),
            ]);
        });
    }

    public function retailPurchase(): BelongsTo
    {
        return $this->belongsTo(RetailPurchase::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Get the inventory history's retail purchase item.
     *
     * @see App\Models\InventoryHistory
     */
    public function inventoryHistory(): MorphOne
    {
        return $this->morphOne(InventoryHistory::class, 'historyable');
    }
}
