<?php

namespace Database\Factories;

use Cable8mm\GoodCode\Enums\GoodCodeType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OptionGoodFactory extends Factory
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
            'author_id' => fake()->randomNumber(1) + 1,
            'goods_code' => GoodCodeType::OPTION->prefix().fake()->randomNumber(3, true),
            'name' => fake()->productName(),
            'my_shop_sale_option_count' => fake()->randomNumber(1),
            'other_shop_sale_option_count' => fake()->randomNumber(1),
            'is_my_shop_sale' => fake()->boolean(),
            'is_other_shop_sale' => fake()->boolean(),
            'is_active' => fake()->boolean(),
        ];
    }
}
