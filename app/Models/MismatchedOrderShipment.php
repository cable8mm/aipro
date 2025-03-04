<?php

namespace App\Models;

use App\Enums\MismatchedOrderShipmentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class MismatchedOrderShipment extends Model
{
    use Actionable, HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'order_no' => 'string',
            'site' => 'string',
            'goods_cd' => 'string',
            'goods_nm' => 'string',
            'option' => 'string',
            'status' => MismatchedOrderShipmentStatus::class,
            'json' => 'object',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (MismatchedOrderShipment $mismatchedOrderShipment) {
            $mismatchedOrderShipment->author_id = $mismatchedOrderShipment->author_id ?? Auth::user()->id;
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function orderSheetWaybill(): BelongsTo
    {
        return $this->belongsTo(OrderSheetWaybill::class);
    }
}
