<?php

namespace Database\Factories;

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
            'user_id' => fake()->randomNumber(1) + 1,
            'master_code' => 'OG'.fake()->randomNumber(3, true),
            'name' => fake()->productName(),
            'option_count' => fake()->randomNumber(2),
            'is_active' => fake()->boolean(),
        ];
    }
}
