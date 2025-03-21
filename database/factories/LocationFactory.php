<?php

namespace Database\Factories;

use Cable8mm\GoodCode\LocationCode;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $uuid = fake()->uuid();

        return [
            'code' => LocationCode::of(warehouse: $uuid),
            'warehouse_id' => fake()->numberBetween(1, 3),
            'description' => fake()->sentence(),
        ];
    }
}
