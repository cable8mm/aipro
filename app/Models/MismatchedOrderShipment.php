<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MismatchedOrderShipment extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'ct_order_sheet_invoice_id' => 'integer',
            'orderNo' => 'string',
            'site' => 'string',
            'masterGoodsCd' => 'string',
            'goodsNm' => 'string',
            'option' => 'string',
            'cms_maestro_id' => 'integer',
            'status' => 'string',
        ];
    }
}
