<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class BoxPlacingOrder extends Model
{
    use Actionable, HasFactory;

    protected $with = ['author', 'warehouseManager', 'boxSupplier'];

    protected function casts(): array
    {
        return [
            'title' => 'string',
            'ordered_at' => 'date',
            'total_box_count' => 'integer',
            'total_order_price' => 'integer',
            'sent_at' => 'datetime',
            'confirmed_at' => 'datetime',
            'predict_warehoused_at' => 'datetime',
            'warehoused_at' => 'datetime',
            'status' => 'string',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (BoxPlacingOrder $boxPlacingOrder) {
            $boxPlacingOrder->author_id = $boxPlacingOrder->author_id ?? Auth::user()->id;
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

    public function placingOrderBoxes(): HasMany
    {
        return $this->hasMany(PlacingOrderBox::class);
    }
}
