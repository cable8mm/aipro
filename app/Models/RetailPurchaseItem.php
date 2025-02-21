<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
