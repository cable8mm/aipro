<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->numerify(),
            'cms_maestro_id' => fake()->randomNumber(),
            'ct_supplier_id' => fake()->randomNumber(),
            'ct_supplier_good_id' => fake()->randomNumber(),
            'ct_box_id' => fake()->randomNumber(),
            'list_image' => fake()->text(),
            'godo_code' => fake()->randomNumber(),
            'retail_code' => fake()->text(),
            'playauto_master_code' => fake()->text(),
            'center_code' => fake()->text(),
            'playauto_category_id' => fake()->randomNumber(),
            'name' => fake()->text(),
            'godo_name' => fake()->text(),
            'option' => fake()->text(),
            'inventory' => fake()->randomNumber(),
            'supplier_out_of_stock_count' => fake()->randomNumber(),
            'manual_add_inventory_memo' => fake()->paragraph(),
            'safe_inventory' => fake()->randomNumber(),
            'safe_class' => fake()->randomLetter(),
            'center_class' => fake()->randomLetter(),
            'category' => fake()->text(),
            'maker' => fake()->text(),
            'brand' => fake()->text(),
            'cost_price' => fake()->randomNumber(),
            'last_cost_price' => fake()->randomNumber(),
            'suggested_selling_price' => fake()->randomNumber(),
            'suggestioned_retail_price' => fake()->randomNumber(),
            'supplier_monitoring_price' => fake()->randomNumber(),
            'supplier_monitoring_status' => fake()->text(),
            'supplier_monitoring_interruption' => fake()->boolean(),
            'goods_price' => fake()->randomNumber(),
            'goods_price_wemake2' => fake()->randomNumber(),
            'goods_price_holapetshop' => fake()->randomNumber(),
            'supplier_name' => fake()->text(),
            'supplier_request_price' => fake()->randomNumber(),
            'supplier_good_code' => fake()->text(),
            'spec' => fake()->text(),
            'order_rule' => fake()->text(),
            'barcode_type' => fake()->text(),
            'barcode' => fake()->text(),
            'generated_barcode' => fake()->text(),
            'picking_box_number' => fake()->text(),
            'storage_box_zone' => fake()->text(),
            'goods_division_color' => fake()->text(),
            'ship_quantity' => fake()->randomNumber(),
            'memo' => fake()->paragraph(),
            'memo_for_center' => fake()->text(),
            'good_classification' => fake()->text(),
            'print_classification' => fake()->text(),
            'naver_category' => fake()->randomLetter(),
            'naver_productid' => fake()->text(),
            'not_exist_naver_productid' => fake()->boolean(),
            'naver_lowest_price_wrong' => fake()->boolean(),
            'naver_lowest_price' => fake()->randomNumber(),
            'internet_lowest_price' => fake()->randomNumber(),
            'zero_margin_price' => fake()->randomNumber(),
            'suggested_sales_percent_margin' => fake()->randomNumber(),
            'suggested_selling_price_of_gms' => fake()->randomNumber(),
            'is_hi300' => fake()->boolean(),
            'is_supplier_out_of_stock' => fake()->boolean(),
            'is_my_shop_sale' => fake()->boolean(),
            'is_other_shop_sale' => fake()->boolean(),
            'is_not_playauto_used' => fake()->boolean(),
            'is_playauto_done' => fake()->boolean(),
            'is_requested_shutdown' => fake()->boolean(),
            'is_requested_reborn' => fake()->boolean(),
            'is_shutdowned' => fake()->boolean(),
            'is_scm_manager_confirmed' => fake()->boolean(),
            'last_warehoused' => fake()->dateTime(),
            'supplier_out_of_stock_on_datetime' => fake()->dateTime(),
            'supplier_out_of_stock_off_datetime' => fake()->dateTime(),
            'created' => fake()->dateTime(),
            'modified' => fake()->dateTime(),
        ];
    }
}
