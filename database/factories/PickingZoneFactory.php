<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PickingZoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $block = fake()->randomElement(['A', 'B', 'C', 'D', 'E', 'F']);
        $lack = fake()->numberBetween(1, 9);

        return [
            'name' => $block.'블록 '.$lack.'랙',
            'code' => $block.$lack,
        ];
    }
}
