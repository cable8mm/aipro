<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Nova\Actions\Actionable;

class PlacingOrder extends Model
{
    use Actionable, HasFactory;

    protected $with = ['user', 'warehouseManager', 'supplier'];

    protected function casts(): array
    {
        return [
            'title' => 'string',
            'ordered_at' => 'datetime',
            'sent_at' => 'datetime',
            'confirmed_at' => 'datetime',
            'predict_warehoused_at' => 'datetime',
            'warehoused_at' => 'datetime',
            'total_good_count' => 'integer',
            'total_order_price' => 'integer',
            'order_discount_percent' => 'integer',
            'status' => 'string',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function warehouseManager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'warehouse_manager_id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function placingOrderGoods(): HasMany
    {
        return $this->hasMany(PlacingOrderGood::class);
    }
}
