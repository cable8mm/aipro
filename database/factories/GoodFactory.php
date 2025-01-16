<?php

namespace Database\Factories;

use App\Enums\GoodColor;
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
        fake()->addProvider(new \Bezhanov\Faker\Provider\Commerce(fake()));
        fake()->addProvider(new \Bezhanov\Faker\Provider\Device(fake()));

        return [
            'user_id' => fake()->randomNumber(1) + 1,
            'supplier_id' => fake()->randomNumber(1) + 1,
            'supplier_good_id' => fake()->randomNumber(1) + 1,
            'box_id' => fake()->randomNumber(1) + 1,
            'list_image' => 'placeholder_list_image.png',
            'master_code' => 'PM'.fake()->randomNumber(3, true),
            'playauto_category_id' => fake()->randomElement([10020400, 10030200, 10060600, 10061000]),
            'name' => fake()->productName(),
            'godo_name' => fake()->productName(),
            'option' => fake()->randomElement([null, 'Large', 'Small', 'Medium']),
            'inventory' => fake()->randomNumber(3),
            'supplier_out_of_stock_count' => fake()->randomNumber(),
            'safe_inventory' => fake()->randomNumber(1),
            'safe_class' => fake()->randomElement(['1', '2', '3', '4', 'X']),
            'center_class' => fake()->randomElement(['M', 'O']),
            'category' => fake()->randomElement(['꽃게|암컷', '꽃게|숫컷']),
            'maker' => fake()->company(),
            'brand' => fake()->deviceManufacturer(),
            'cost_price' => fake()->randomNumber(5),
            'last_cost_price' => fake()->randomNumber(5),
            'suggested_selling_price' => fake()->randomNumber(5),
            'suggested_retail_price' => fake()->randomNumber(5),
            'supplier_monitoring_price' => fake()->randomNumber(5),
            'supplier_monitoring_status' => fake()->text(10),
            'supplier_monitoring_interruption' => fake()->boolean(),
            'goods_price' => fake()->randomNumber(5),
            'spec' => fake()->randomElement(['5g*10p', '15mm']),
            'order_rule' => fake()->randomElement(['12', '24']),
            'barcode' => fake()->ean13(),
            'picking_box_number' => fake()->bothify('??-##-###'),
            'goods_division_color' => fake()->randomElement(GoodColor::names()),
            'ship_quantity' => fake()->randomElement([1, 2, 4, 8, 16]),
            'memo' => fake()->paragraph(),
            'print_classification' => fake()->text(190),
            'naver_category' => '5'.fake()->randomNumber(7),
            'naver_productid' => fake()->randomNumber(9),
            'naver_lowest_price_wrong' => fake()->boolean(),
            'naver_lowest_price' => fake()->randomNumber(),
            'internet_lowest_price' => fake()->randomNumber(),
            'zero_margin_price' => fake()->randomNumber(),
            'is_supplier_out_of_stock' => fake()->boolean(),
            'can_be_shipped' => fake()->boolean(),
            'is_shutdown' => fake()->boolean(),
        ];
    }
}
