<?php

namespace App\Models;

use Cable8mm\GoodCode\ReceiptCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class BoxPurchaseOrder extends Model
{
    use Actionable, HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'code' => 'string',
            'purchase_ordered_at' => 'datetime',
            'predict_warehoused_at' => 'datetime',
            'warehoused_at' => 'datetime',
            'total_box_count' => 'integer',
            'total_order_price' => 'integer',
            'discount_amount' => 'integer',
            'status' => 'string',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (BoxPurchaseOrder $boxPurchaseOrder) {
            $boxPurchaseOrder->author_id = $boxPurchaseOrder->author_id ?? Auth::user()->id;

            $boxPurchaseOrder->code = ReceiptCode::of(optional(
                static::query()->latest('id')->first()
            )->code, 'BO')->nextCode();
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

    public function boxSupplier(): BelongsTo
    {
        return $this->belongsTo(BoxSupplier::class);
    }

    public function boxPurchaseOrderItems(): HasMany
    {
        return $this->hasMany(BoxPurchaseOrderItem::class);
    }

    public function updateTotalGoodCount(): bool
    {
        $this->total_box_count = $this->boxPurchaseOrderItems()->count();
        $this->total_order_price = $this->boxPurchaseOrderItems()->sum('subtotal');

        return $this->save();
    }
}
