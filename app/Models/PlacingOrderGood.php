<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Nova\Actions\Actionable;

class PlacingOrderGood extends Model
{
    use Actionable, HasFactory;

    protected $with = ['placingOrder', 'author', 'warehouseManager', 'good'];

    protected function casts(): array
    {
        return [
            'order_count' => 'integer',
            'order_price' => 'integer',
            'supplier_confirmed_count' => 'integer',
            'supplier_confirmed_price' => 'integer',
            'cost_count' => 'integer',
            'cost_promotion_count' => 'integer',
            'cost_price' => 'integer',
            'is_promotion' => 'boolean',
            'warehoused_at' => 'datetime',
            'status' => 'string',
            'placing_ordered_at' => 'datetime',
        ];
    }

    public function placingOrder(): BelongsTo
    {
        return $this->belongsTo(PlacingOrder::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function warehouseManager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'warehouse_manager_id');
    }

    public function good(): BelongsTo
    {
        return $this->belongsTo(Good::class);
    }
}
