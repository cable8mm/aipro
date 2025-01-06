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
            'requester_id' => fake()->randomNumber(),
            'worker_id' => fake()->randomNumber(),
            'title' => fake()->text(190),
            'request_file_url' => fake()->text(190),
            'status' => fake()->text(10),
            'respond_file_url' => fake()->text(190),
            'memo' => fake()->paragraph(),
            'created_at' => fake()->unixTime(),
            'updated_at' => fake()->unixTime(),
        ];
    }
}
