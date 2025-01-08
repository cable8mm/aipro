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
        fake()->addProvider(new \Bezhanov\Faker\Provider\Commerce(fake()));
        fake()->addProvider(new \Bezhanov\Faker\Provider\Device(fake()));

        return [
            'user_id' => fake()->randomNumber(1) + 1,
            'option_good_id' => fake()->randomNumber(1) + 1,
            'master_code' => 'OGO'.fake()->randomNumber(3, true),
            'name' => fake()->productName(),
            'goods_price' => fake()->randomNumber(5),
            'last_cost_price' => fake()->randomNumber(5),
            'zero_margin_price' => fake()->randomNumber(5),
            'order' => fake()->randomNumber(2),
        ];
    }
}
