<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RegisterGoodRequestFactory extends Factory
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
            'requester_id' => fake()->randomNumber(),
            'title' => fake()->text(),
            'request_file_url' => fake()->text(),
            'worker_id' => fake()->randomNumber(),
            'respond_file_url' => fake()->text(),
            'has_supplier_monitoring_price' => fake()->numberBetween(0, 127),
            'memo' => fake()->paragraph(),
            'status' => fake()->text(),
            'created' => fake()->dateTime(),
            'modified' => fake()->dateTime(),
        ];
    }
}
