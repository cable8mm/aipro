<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class WaybillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'NO' => fake()->text(),
            'waybill_number' => fake()->text(),
            '송하인' => fake()->text(),
            '받는분' => fake()->text(),
            '전화번호' => fake()->text(),
            '휴대번호' => fake()->text(),
            '주소' => fake()->paragraph(),
            '현재상태' => fake()->text(),
            '최종상품점소' => fake()->text(),
            '처리시간' => fake()->text(),
            '접수일자' => fake()->text(),
            '집화일자' => fake()->text(),
            '배달일' => fake()->text(),
            '인수자' => fake()->text(),
            '집화상위점소' => fake()->text(),
            '집화점소' => fake()->text(),
            '배달상위점소' => fake()->text(),
            '배달점소' => fake()->text(),
            '주문번호' => fake()->text(),
            '품명' => fake()->text(),
            '운임구분' => fake()->text(),
            '박스타입' => fake()->text(),
            '수량' => fake()->text(),
            '금액' => fake()->text(),
            '접수구분' => fake()->text(),
        ];
    }
}
