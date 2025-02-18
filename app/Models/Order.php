<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Nova\Actions\Actionable;

class Order extends Model
{
    use Actionable, HasFactory;

    protected $with = ['orderSheetInvoice'];

    protected function casts(): array
    {
        return [
            'boxes' => 'array',
            'type' => 'array',
            'order_good_count' => 'integer',
            'printed_count' => 'integer',
        ];
    }

    public function orderSheetInvoice(): BelongsTo
    {
        return $this->belongsTo(OrderSheetInvoice::class);
    }

    public function orderShipments(): HasMany
    {
        return $this->hasMany(OrderShipment::class, 'orderNo', 'id');
    }

    public function latestOrderShipment(): HasOne
    {
        return $this->hasOne(OrderShipment::class, 'orderNo', 'id')->latestOfMany();
    }

    public function goods(): HasManyThrough
    {
        return $this->hasManyThrough(Good::class, OrderShipment::class, 'orderNo', 'master_code', 'id', 'masterGoodsCd');
    }

    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class);
    }
}
