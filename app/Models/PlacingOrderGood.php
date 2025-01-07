<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacingOrderGood extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'ct_order_id' => 'integer',
            'cms_maestro_id' => 'integer',
            'ct_good_id' => 'integer',
            'warehouse_manager_id' => 'integer',
            'order_count' => 'integer',
            'order_price' => 'integer',
            'supplier_confirmed_count' => 'integer',
            'supplier_confirmed_price' => 'integer',
            'cost_count' => 'integer',
            'cost_promotion_count' => 'integer',
            'cost_price' => 'integer',
            'is_promotion' => 'boolean',
            'warehoused' => 'datetime',
            'status' => 'string',
            'ordered' => 'datetime',
        ];
    }
}
