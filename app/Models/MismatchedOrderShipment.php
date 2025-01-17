<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Nova\Actions\Actionable;

class MismatchedOrderShipment extends Model
{
    use Actionable, HasFactory;

    protected function casts(): array
    {
        return [
            'orderNo' => 'string',
            'site' => 'string',
            'masterGoodsCd' => 'string',
            'goodsNm' => 'string',
            'option' => 'string',
            'status' => 'string',
            'json' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderSheetInvoice(): BelongsTo
    {
        return $this->belongsTo(OrderSheetInvoice::class);
    }
}
