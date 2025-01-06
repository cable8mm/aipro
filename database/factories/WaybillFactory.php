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
            'NO' => fake()->text(190),
            'waybill_number' => fake()->text(190),
            '송하인' => fake()->text(255),
            '받는분' => fake()->text(255),
            '전화번호' => fake()->text(255),
            '휴대번호' => fake()->text(255),
            '주소' => fake()->paragraph(),
            '현재상태' => fake()->text(255),
            '최종상품점소' => fake()->text(255),
            '처리시간' => fake()->text(255),
            '접수일자' => fake()->text(255),
            '집화일자' => fake()->text(255),
            '배달일' => fake()->text(255),
            '인수자' => fake()->text(255),
            '집화상위점소' => fake()->text(255),
            '집화점소' => fake()->text(255),
            '배달상위점소' => fake()->text(255),
            '배달점소' => fake()->text(255),
            '주문번호' => fake()->text(255),
            '품명' => fake()->text(255),
            '운임구분' => fake()->text(255),
            '박스타입' => fake()->text(255),
            '수량' => fake()->text(255),
            '금액' => fake()->text(255),
            '접수구분' => fake()->text(255),
        ];
    }
}
