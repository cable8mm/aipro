<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierGood extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'ct_supplier_id' => 'integer',
            'good_code' => 'string',
            'center_code' => 'string',
            'supplier_attribute' => 'string',
            'supplier_category' => 'string',
            'godo_name' => 'string',
            'gn' => 'string',
            'name' => 'string',
            'origin' => 'string',
            'maker' => 'string',
            'brand' => 'string',
            'box_count' => 'integer',
            'quantity_in_box' => 'integer',
            'min_order_count' => 'string',
            'current_barcode' => 'string',
            'barcode' => 'string',
            'box_barcode' => 'string',
            'spec' => 'string',
            'inventory' => 'integer',
            'price' => 'integer',
            'suggested_selling_price' => 'integer',
            'suggestioned_retail_price' => 'integer',
            'supplier_monitoring_price' => 'integer',
            'ead' => 'date',
            'is_information_manual_sync' => 'boolean',
            'is_runout' => 'boolean',
            'is_warehoused' => 'boolean',
            'is_shutdowned' => 'boolean',
            'supplier_created' => 'date',
            'supplier_modified' => 'date',
        ];
    }
}
