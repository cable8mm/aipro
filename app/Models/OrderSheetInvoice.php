<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderSheetInvoice extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'excel_filepath' => 'string',
            'order_row_count' => 'integer',
            'order_number_count' => 'integer',
            'order_good_count' => 'integer',
            'mismatched_order_good_count' => 'integer',
            'invoice_filepath' => 'string',
            'excel_json' => 'array',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function orderShipments(): HasMany
    {
        return $this->hasMany(OrderShipment::class);
    }
}
