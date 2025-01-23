<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class OrderSheetInvoice extends Model
{
    use HasFactory;

    protected $with = ['author'];

    protected function casts(): array
    {
        return [
            'row_count' => 'integer',
            'order_count' => 'integer',
            'order_good_count' => 'integer',
            'mismatched_order_good_count' => 'integer',
            'order_sheet_file' => 'string',
            'order_sheet_file_name' => 'string',
            'order_sheet_file_size' => 'integer',
            'invoice_file' => 'string',
            'invoice_file_name' => 'string',
            'invoice_file_size' => 'integer',
            'excel_json' => 'json',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (OrderSheetInvoice $orderSheetInvoice) {
            $orderSheetInvoice->author_id = $orderSheetInvoice->author_id ?? Auth::user()->id;
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
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
