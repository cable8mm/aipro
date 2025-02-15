<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Nova\Actions\Actionable;

class PlacingOrderBox extends Model
{
    use Actionable, HasFactory;

    protected $with = ['boxPlacingOrder', 'author', 'boxSupplier', 'box', 'warehouseManager'];

    protected function casts(): array
    {
        return [
            'order_count' => 'integer',
            'order_price' => 'integer',
            'cost_count' => 'integer',
            'cost_price' => 'integer',
            'warehoused_at' => 'datetime',
            'status' => 'string',
        ];
    }

    public function boxPlacingOrder(): BelongsTo
    {
        return $this->belongsTo(BoxPlacingOrder::class);
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
