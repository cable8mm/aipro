<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RetailPurchase extends Model
{
    /** @use HasFactory<\Database\Factories\RetailPurchaseFactory> */
    use HasFactory;

    protected $casts = [
        'purchased_at' => 'date',
    ];

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
