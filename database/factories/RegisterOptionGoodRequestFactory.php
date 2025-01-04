<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RegisterOptionGoodRequestFactory extends Factory
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
            'worker_id' => fake()->randomNumber(),
            'title' => fake()->text(),
            'request_file_url' => fake()->text(),
            'status' => fake()->text(),
            'respond_file_url' => fake()->text(),
            'memo' => fake()->paragraph(),
            'created' => fake()->dateTime(),
            'modified' => fake()->dateTime(),
        ];
    }
}
