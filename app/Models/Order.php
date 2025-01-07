<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'order_sheet_invoice_id' => 'integer',
            'type' => 'string',
            'is_all_good_matched' => 'boolean',
            'has_center_class_j' => 'boolean',
            'order_good_count' => 'integer',
            'printed_count' => 'integer'
        ];
    }
}
