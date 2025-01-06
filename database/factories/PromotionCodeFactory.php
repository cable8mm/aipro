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
            'playauto_master_code' => fake()->text(100),
            'godo_code' => fake()->text(255),
            'memo' => fake()->text(190),
            'started' => fake()->dateTime(),
            'finished' => fake()->dateTime(),
            'created_at' => fake()->unixTime(),
            'updated_at' => fake()->unixTime(),
            'cms_maestro_id' => fake()->randomNumber(),
        ];
    }
}
