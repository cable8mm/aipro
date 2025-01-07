<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelGood extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'playauto_master_code' => 'string',
            'goods_bar' => 'string',
            'coupang_price' => 'integer',
            'coupang_sale_status' => 'string',
            'coupang_approved' => 'string',
            'coupang_inventory' => 'integer',
            'kakaotalk_price' => 'integer',
            'kakaotalk_sale_status' => 'string',
            'kakaotalk_inventory' => 'integer',
            'ssg_price' => 'integer',
            'ssg_sale_status' => 'string',
            'ssg_inventory' => 'integer',
            '11st_price' => 'integer',
            '11st_sale_status' => 'string',
            '11st_inventory' => 'integer',
            'gmarket_price' => 'integer',
            'gmarket_sale_status' => 'string',
            'gmarket_inventory' => 'integer',
            'storefarm_channel' => 'string',
            'storefarm_price' => 'integer',
            'storefarm_sale_status' => 'string',
            'storefarm_inventory' => 'integer',
            'auction_price' => 'integer',
            'auction_sale_status' => 'string',
            'auction_inventory' => 'integer',
            'wemake_price' => 'integer',
            'wemake_sale_status' => 'string',
            'gift_price' => 'integer',
            'gift_sale_status' => 'string',
            'gift_inventory' => 'integer'
        ];
    }
}
