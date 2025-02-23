<?php

namespace App\Models;

use App\Enums\RetailPurchaseStatus;
use Cable8mm\GoodCode\ReceiptCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Auth;

class RetailPurchase extends Model
{
    /** @use HasFactory<\Database\Factories\RetailPurchaseFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'purchased_at' => 'date',
    ];

    protected static function booted(): void
    {
        static::creating(function (RetailPurchase $retailPurchase) {
            $retailPurchase->code = ReceiptCode::of(optional(
                static::query()->latest('id')->first()
            )->code, prefix: 'RP')->nextCode();
        });

        static::updating(function (RetailPurchase $retailPurchase) {
            $retailPurchase->cashier_id = $retailPurchase->cashier_id ?? Auth::user()->id;

            if (
                $retailPurchase->status == RetailPurchaseStatus::COMPLETED->name
                && $retailPurchase->getOriginal('status') != RetailPurchaseStatus::COMPLETED->name
            ) {
                $retailPurchase->retailPurchaseItems()->each(function (RetailPurchaseItem $retailPurchaseItem) {
                    $retailPurchaseItem->item->plusminus($retailPurchaseItem->quantity * -1, __CLASS__, $retailPurchaseItem->id);
                });
            }
        });
    }

    public function cashier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function retailPurchaseItems(): HasMany
    {
        return $this->hasMany(RetailPurchaseItem::class);
    }

    public function getTotalPrice(): int
    {
        return $this->retailPurchaseItems->sum('subtotal');
    }

    public function getItemCount(): int
    {
        return $this->retailPurchaseItems->count();
    }

    /**
     * Get the inventory history's retail purchase.
     */
    public function inventoryHistory(): MorphOne
    {
        return $this->morphOne(InventoryHistory::class, 'historyable');
    }
}
