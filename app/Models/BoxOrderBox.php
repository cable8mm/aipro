<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Nova\Actions\Actionable;

class BoxOrderBox extends Model
{
    use Actionable, HasFactory;

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

    public function boxOrder(): BelongsTo
    {
        return $this->belongsTo(BoxOrder::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
