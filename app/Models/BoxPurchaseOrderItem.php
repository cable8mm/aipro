<?php

namespace App\Models;

use App\Enums\PurchaseOrderItemStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
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
            'status' => PurchaseOrderItemStatus::class,
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

    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class);
    }

    public function warehouseManager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'warehouse_manager_id');
    }

    /**
     * Create a new purchase order item for returning.
     *
     * @param  int  $quantity  The quantity of the item returned, in general the value should be negative value.
     * @return static The new purchase order item for returning.
     *
     * @throws \RuntimeException
     */
    public function returned(int $quantity): static
    {
        if (PurchaseOrderItemStatus::cannot($this->status, PurchaseOrderItemStatus::RETURNED)) {
            throw new \RuntimeException(__('The status cannot be changed.'));
        }

        $replicate = $this->replicate()->fill([
            'status' => PurchaseOrderItemStatus::RETURNED,
            'quantity' => $quantity,
            'subtotal' => $quantity * $this->unit_price,
        ]);

        return tap($replicate)->save();
    }

    /**
     * Get the box inventory history's box purchase order item.
     *
     * @see \App\Models\BoxInventoryHistory
     */
    public function boxInventoryHistory(): MorphOne
    {
        return $this->morphOne(BoxInventoryHistory::class, 'historyable');
    }
}
