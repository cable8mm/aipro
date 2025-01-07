<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacingOrder extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'cms_maestro_id' => 'integer',
            'warehouse_manager_id' => 'integer',
            'ct_supplier_id' => 'integer',
            'title' => 'string',
            'order_date' => 'date',
            'total_good_count' => 'integer',
            'total_order_price' => 'integer',
            'order_discount_percent' => 'integer',
            'is_applied_order_discount_percent' => 'boolean',
            'sent' => 'datetime',
            'confirmed' => 'datetime',
            'predict_warehoused' => 'date',
            'warehoused' => 'datetime',
            'status' => 'string'
        ];
    }
}
