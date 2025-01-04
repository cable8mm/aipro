<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GoodInventorySnapshotFactory extends Factory
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
            'ct_good_id' => fake()->randomNumber(),
            'playauto_master_code' => fake()->text(),
            'inventory' => fake()->randomNumber(),
            'safe_class' => fake()->randomLetter(),
            'type' => fake()->text(),
            'created' => fake()->dateTime(),
        ];
    }
}
