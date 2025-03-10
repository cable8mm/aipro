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
            'author_id' => fake()->randomNumber(1) + 1,
            'option_good_id' => fake()->randomNumber(1) + 1,
            'name' => fake()->text(10),
            'optionable_type' => fake()->randomElement(['App\Models\Good', 'App\Models\SetGood']), // change this to your model class name
            'optionable_id' => fake()->randomNumber(1) + 1,
        ];
    }
}
