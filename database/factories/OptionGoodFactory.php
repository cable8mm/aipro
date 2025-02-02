<?php

namespace Database\Factories;

use Cable8mm\GoodCodeParser\Parsers\OptionGood;
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
            'master_code' => OptionGood::PREFIX.fake()->randomNumber(3, true),
            'name' => fake('ko_KR')->productName(),
            'option_count' => fake()->randomNumber(2),
            'my_shop_sale_option_count' => fake()->randomNumber(1),
            'other_shop_sale_option_count' => fake()->randomNumber(1),
            'is_active' => fake()->boolean(),
        ];
    }
}
