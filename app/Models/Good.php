<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'cms_maestro_id' => 'integer',
            'ct_supplier_id' => 'integer',
            'ct_supplier_good_id' => 'integer',
            'ct_box_id' => 'integer',
            'list_image' => 'string',
            'godo_code' => 'integer',
            'retail_code' => 'string',
            'playauto_master_code' => 'string',
            'center_code' => 'string',
            'playauto_category_id' => 'integer',
            'name' => 'string',
            'godo_name' => 'string',
            'option' => 'string',
            'inventory' => 'integer',
            'supplier_out_of_stock_count' => 'integer',
            'safe_inventory' => 'integer',
            'category' => 'string',
            'maker' => 'string',
            'brand' => 'string',
            'cost_price' => 'integer',
            'last_cost_price' => 'integer',
            'suggested_selling_price' => 'integer',
            'suggestioned_retail_price' => 'integer',
            'supplier_monitoring_price' => 'integer',
            'supplier_monitoring_status' => 'string',
            'supplier_monitoring_interruption' => 'boolean',
            'goods_price' => 'integer',
            'goods_price_wemake2' => 'integer',
            'goods_price_holapetshop' => 'integer',
            'supplier_name' => 'string',
            'supplier_request_price' => 'integer',
            'supplier_good_code' => 'string',
            'spec' => 'string',
            'order_rule' => 'string',
            'barcode_type' => 'string',
            'barcode' => 'string',
            'generated_barcode' => 'string',
            'picking_box_number' => 'string',
            'storage_box_zone' => 'string',
            'goods_division_color' => 'string',
            'ship_quantity' => 'integer',
            'memo_for_center' => 'string',
            'good_classification' => 'string',
            'print_classification' => 'string',
            'naver_productid' => 'string',
            'not_exist_naver_productid' => 'boolean',
            'naver_lowest_price_wrong' => 'boolean',
            'naver_lowest_price' => 'integer',
            'internet_lowest_price' => 'integer',
            'zero_margin_price' => 'integer',
            'suggested_sales_percent_margin' => 'integer',
            'suggested_selling_price_of_gms' => 'integer',
            'is_hi300' => 'boolean',
            'is_supplier_out_of_stock' => 'boolean',
            'is_my_shop_sale' => 'boolean',
            'is_other_shop_sale' => 'boolean',
            'is_not_playauto_used' => 'boolean',
            'is_playauto_done' => 'boolean',
            'is_requested_shutdown' => 'boolean',
            'is_requested_reborn' => 'boolean',
            'is_shutdowned' => 'boolean',
            'is_scm_manager_confirmed' => 'boolean',
            'last_warehoused' => 'datetime',
            'supplier_out_of_stock_on_datetime' => 'datetime',
            'supplier_out_of_stock_off_datetime' => 'datetime'
        ];
    }
}
