<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\RetailPurchaseStatus;
use Cable8mm\GoodCode\ReceiptCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class RetailPurchase extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'code' => 'string',
        'item_count' => 'integer',
        'total_price' => 'integer',
        'payment_method' => PaymentMethod::class,
        'status' => RetailPurchaseStatus::class,
        'discount' => 'integer',
        'tax' => 'integer',
        'purchased_at' => 'datetime',
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
                $retailPurchase->status == RetailPurchaseStatus::COMPLETED
                && $retailPurchase->getOriginal('status') != RetailPurchaseStatus::COMPLETED
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

    /**
     * ???
     */
    // public function item(): BelongsTo
    // {
    //     return $this->belongsTo(Item::class);
    // }

    public function getTotalPrice(): int
    {
        return $this->retailPurchaseItems->sum('subtotal');
    }

    public function getItemCount(): int
    {
        return $this->retailPurchaseItems->count();
    }
}
