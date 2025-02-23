<?php

namespace App\Models;

use App\Enums\PurchaseOrderItemStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class PurchaseOrderItem extends Model
{
    use Actionable, HasFactory;

    protected $with = ['purchaseOrder', 'author', 'warehouseManager', 'item'];

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
        static::creating(function (PurchaseOrderItem $purchaseOrderItem) {
            $purchaseOrderItem->author_id = $purchaseOrderItem->author_id ?? Auth::user()->id;
        });

        static::saved(function (PurchaseOrderItem $purchaseOrderItem) {
            $purchaseOrderItem->purchaseOrder->updateTotalGoodCount();
        });
    }

    public function purchaseOrder(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function warehouseManager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'warehouse_manager_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
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
            'status' => PurchaseOrderItemStatus::RETURNED->name,
            'quantity' => $quantity,
            'subtotal' => $quantity * $this->unit_price,
        ]);

        return tap($replicate)->save();
    }
}
