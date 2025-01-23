<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Nova\Actions\Actionable;

class Order extends Model
{
    use Actionable, HasFactory;

    protected $with = ['orderSheetInvoice'];

    protected function casts(): array
    {
        return [
            'type' => 'array',
            'order_good_count' => 'integer',
            'printed_count' => 'integer',
            'is_all_good_matched' => 'boolean',
        ];
    }

    public function orderSheetInvoice(): BelongsTo
    {
        return $this->belongsTo(OrderSheetInvoice::class);
    }
}
