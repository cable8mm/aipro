<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Laravel\Nova\Actions\Actionable;

class Order extends Model
{
    use Actionable, HasFactory;

    protected $guarded = [];

    protected $with = ['orderSheetWaybill'];

    protected function casts(): array
    {
        return [
            'boxes' => 'array',
            'type' => 'array',
            'order_good_count' => 'integer',
            'printed_count' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            $order->box_id = $order->box_id ?? Box::default()->id;
        });
    }

    public function orderSheetWaybill(): BelongsTo
    {
        return $this->belongsTo(OrderSheetWaybill::class);
    }

    public function orderShipments(): HasMany
    {
        return $this->hasMany(OrderShipment::class, 'orderNo', 'id');
    }

    public function latestOrderShipment(): HasOne
    {
        return $this->hasOne(OrderShipment::class, 'orderNo', 'id')->latestOfMany();
    }

    public function items(): HasManyThrough
    {
        return $this->hasManyThrough(Item::class, OrderShipment::class, 'orderNo', 'sku', 'id', 'goodsCd');
    }

    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class);
    }

    /**
     * Get the box inventory history's order.
     */
    public function boxInventoryHistory(): MorphOne
    {
        return $this->morphOne(BoxInventoryHistory::class, 'historyable');
    }
}
