<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoxOrder extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'cms_maestro_id' => 'integer',
            'warehouse_manager_id' => 'integer',
            'ct_box_supplier_id' => 'integer',
            'title' => 'string',
            'order_date' => 'date',
            'total_box_count' => 'integer',
            'total_order_price' => 'integer',
            'sent' => 'datetime',
            'confirmed' => 'datetime',
            'predict_warehoused' => 'datetime',
            'warehoused' => 'datetime',
            'status' => 'string',
        ];
    }
}
