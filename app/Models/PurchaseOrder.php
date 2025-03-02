<?php

namespace App\Models;

use App\Enums\PurchaseOrderStatus;
use Cable8mm\GoodCode\ReceiptCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class PurchaseOrder extends Model
{
    use Actionable, HasFactory;

    protected $with = ['author', 'warehouseManager', 'supplier'];

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'code' => 'string',
            'purchase_ordered_at' => 'datetime',
            'predict_warehoused_at' => 'datetime',
            'warehoused_at' => 'datetime',
            'total_good_count' => 'integer',
            'total_order_price' => 'integer',
            'discount_amount' => 'integer',
            'status' => PurchaseOrderStatus::class,
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (PurchaseOrder $purchaseOrder) {
            $purchaseOrder->author_id = $purchaseOrder->author_id ?? Auth::user()->id;

            $purchaseOrder->code = ReceiptCode::of(optional(
                static::query()->latest('id')->first()
            )->code, 'PO')->nextCode();
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function warehouseManager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'warehouse_manager_id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseOrderItems(): HasMany
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function updateTotalGoodCount(): bool
    {
        $this->total_good_count = $this->purchaseOrderItems()->count();
        $this->total_order_price = $this->purchaseOrderItems()->sum('subtotal');

        return $this->save();
    }
}
