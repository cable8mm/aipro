<?php

namespace App\Models;

use App\Enums\RetailPurchaseStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class RetailPurchase extends Model
{
    /** @use HasFactory<\Database\Factories\RetailPurchaseFactory> */
    use HasFactory;

    protected $casts = [
        'purchased_at' => 'date',
    ];

    protected static function booted(): void
    {
        static::saving(function (RetailPurchase $retailPurchase) {
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
}
