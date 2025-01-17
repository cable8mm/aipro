<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Nova\Actions\Actionable;

class SupplierGood extends Model
{
    use Actionable, HasFactory;

    protected function casts(): array
    {
        return [
            'good_code' => 'string',
            'center_code' => 'string',
            'supplier_category' => 'string',
            'name' => 'string',
            'origin' => 'string',
            'maker' => 'string',
            'brand' => 'string',
            'box_count' => 'integer',
            'quantity_in_box' => 'integer',
            'min_order_count' => 'string',
            'barcode' => 'string',
            'spec' => 'string',
            'inventory' => 'integer',
            'price' => 'integer',
            'suggested_selling_price' => 'integer',
            'suggested_retail_price' => 'integer',
            'supplier_monitoring_price' => 'integer',
            'is_runout' => 'boolean',
            'is_warehoused' => 'boolean',
            'is_shutdown' => 'boolean',
        ];
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
