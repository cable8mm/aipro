<?php

namespace Database\Factories;

use App\Enums\Status;
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
            'author_id' => fake()->randomNumber(1) + 1,
            'title' => date('Y년 m월 n일').' 상품등록 요청 드립니다.',
            'request_file_url' => fake()->word().'.xlsx',
            'worker_id' => fake()->randomNumber(1) + 1,
            'respond_file_url' => fake()->word().'.xlsx',
            'has_supplier_monitoring_price' => fake()->boolean(),
            'memo' => fake()->paragraph(),
            'status' => fake()->randomElement(Status::names()),
        ];
    }
}
