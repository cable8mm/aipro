<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Nova\Actions\Actionable;

class Order extends Model
{
    use Actionable, HasFactory;

    protected function casts(): array
    {
        return [
            'type' => 'string',
            'is_all_good_matched' => 'boolean',
            'has_center_class_j' => 'boolean',
            'order_good_count' => 'integer',
            'printed_count' => 'integer',
        ];
    }

    public function orderSheetInvoice(): BelongsTo
    {
        return $this->belongsTo(OrderSheetInvoice::class);
    }
}
