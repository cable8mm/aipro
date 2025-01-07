<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionGoodOption extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'cms_maestro_id' => 'integer',
            'ct_option_good_id' => 'integer',
            'playauto_master_code' => 'string',
            'name' => 'string',
            'goods_price' => 'integer',
            'last_cost_price' => 'integer',
            'zero_margin_price' => 'integer',
            'suggested_selling_price_of_gms' => 'integer',
            'order' => 'integer',
            'goods_bar' => 'string',
            'is_my_shop_sale' => 'boolean',
            'is_other_shop_sale' => 'boolean'
        ];
    }
}
