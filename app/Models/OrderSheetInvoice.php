<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSheetInvoice extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'cms_maestro_id' => 'integer',
            'name' => 'string',
            'excel_filepath' => 'string',
            'order_row_count' => 'integer',
            'order_number_count' => 'integer',
            'order_good_count' => 'integer',
            'mismatched_order_good_count' => 'integer',
            'invoice_filepath' => 'string',
            'status' => 'string'
        ];
    }
}
