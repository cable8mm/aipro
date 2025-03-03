<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SetGoodFactory extends Factory
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
            'name' => fake()->productName(),
            'good_count' => fake()->numberBetween(1, 10),
            'goods_price' => fake()->numberBetween(1000, 50000),
            'last_cost_price' => fake()->numberBetween(1000, 50000),
            'zero_margin_price' => fake()->numberBetween(1000, 50000),
            'is_shutdown' => fake()->boolean(),
        ];
    }
}
