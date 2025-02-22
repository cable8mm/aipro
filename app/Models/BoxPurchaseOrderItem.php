<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class BoxPurchaseOrderItem extends Model
{
    use Actionable, HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'subtotal' => 'integer',
            'unit_price' => 'integer',
            'warehoused_at' => 'datetime',
            'purchase_ordered_at' => 'datetime',
            'status' => 'string',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (BoxPurchaseOrderItem $boxPurchaseOrderItem) {
            $boxPurchaseOrderItem->author_id = $boxPurchaseOrderItem->author_id ?? Auth::user()->id;
        });

        static::saved(function (BoxPurchaseOrderItem $boxPurchaseOrderItem) {
            $boxPurchaseOrderItem->boxPurchaseOrder->updateTotalGoodCount();
        });
    }

    public function boxPurchaseOrder(): BelongsTo
    {
        return $this->belongsTo(BoxPurchaseOrder::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function boxSupplier(): BelongsTo
    {
        return $this->belongsTo(BoxSupplier::class);
    }

    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class);
    }

    public function warehouseManager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'warehouse_manager_id');
    }
}
