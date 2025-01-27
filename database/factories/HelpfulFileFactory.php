<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HelpfulFile>
 */
class HelpfulFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => fake()->numberBetween(1, 10),
            'attachment' => fake()->word().'.xlsx',
            'description' => fake()->randomElement(['상품 업로드용 엑셀파일입니다.', '주문서 업로드용 엑셀파일입니다.', '상품 발주서 엑셀파일입니다.', '박스 발주서 엑셀파일입니다.']),
        ];
    }
}
