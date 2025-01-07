<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsBar extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'playauto_master_code' => 'string',
            'goods_bar' => 'string',
            'is_my_shop_sale' => 'boolean',
            'is_other_shop_sale' => 'boolean'
        ];
    }
}
