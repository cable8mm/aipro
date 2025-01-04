<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PromotionCodeFactory extends Factory
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
            'playauto_master_code' => fake()->text(),
            'godo_code' => fake()->text(),
            'memo' => fake()->text(),
            'started' => fake()->dateTime(),
            'finished' => fake()->dateTime(),
            'created' => fake()->dateTime(),
            'modified' => fake()->dateTime(),
            'cms_maestro_id' => fake()->randomNumber(),
        ];
    }
}
