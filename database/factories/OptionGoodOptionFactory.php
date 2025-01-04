<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OptionGoodOptionFactory extends Factory
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
            'ct_option_good_id' => fake()->randomNumber(),
            'playauto_master_code' => fake()->text(),
            'name' => fake()->text(),
            'goods_price' => fake()->randomNumber(),
            'last_cost_price' => fake()->randomNumber(),
            'zero_margin_price' => fake()->randomNumber(),
            'suggested_selling_price_of_gms' => fake()->randomNumber(),
            'order' => fake()->randomNumber(),
            'goods_bar' => fake()->text(),
            'is_my_shop_sale' => fake()->boolean(),
            'is_other_shop_sale' => fake()->boolean(),
            'created' => fake()->dateTime(),
            'modified' => fake()->dateTime(),
        ];
    }
}
