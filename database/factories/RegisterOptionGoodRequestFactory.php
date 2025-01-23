<?php

namespace Database\Factories;

use App\Enums\Status;
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
            'author_id' => fake()->randomNumber(1) + 1,
            'worker_id' => fake()->randomNumber(1) + 1,
            'title' => date('Y년 m월 n일').' 옵션상품 등록 요청드립니다.',
            'request_file_url' => fake()->word().'.xlsx',
            'status' => fake()->randomElement(Status::names()),
            'respond_file_url' => fake()->word().'.xlsx',
            'memo' => fake()->paragraph(),
        ];
    }
}
