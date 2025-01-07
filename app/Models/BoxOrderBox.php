<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoxOrderBox extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'ct_box_order_id' => 'integer',
            'cms_maestro_id' => 'integer',
            'ct_box_supplier_id' => 'integer',
            'ct_box_id' => 'integer',
            'warehouse_manager_id' => 'integer',
            'order_count' => 'integer',
            'order_price' => 'integer',
            'cost_count' => 'integer',
            'cost_price' => 'integer',
            'warehoused' => 'datetime',
            'status' => 'string'
        ];
    }
}
