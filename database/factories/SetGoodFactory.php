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
            'user_id' => fake()->randomNumber(1) + 1,
            'master_code' => fake()->randomElement(['SET1x1ZZ3x1', 'SET3x3ZZ7x3', 'SET6x4ZZ8x4']),
            'featured_good_list' => fake()->randomNumber(1) + 1,
            'name' => fake()->productName(),
            'goods_price' => fake()->randomNumber(5),
            'last_cost_price' => fake()->randomNumber(5),
            'zero_margin_price' => fake()->randomNumber(5),
            'is_shutdown' => fake()->boolean(),
        ];
    }
}
