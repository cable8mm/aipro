<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MismatchedOrderShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ct_order_sheet_invoice_id' => fake()->randomNumber(),
            'orderNo' => fake()->text(100),
            'site' => fake()->text(100),
            'masterGoodsCd' => fake()->text(100),
            'goodsNm' => fake()->text(255),
            'option' => fake()->text(255),
            'json' => fake()->paragraph(),
            'cms_maestro_id' => fake()->randomNumber(),
            'status' => fake()->text(100),
            'created_at' => fake()->unixTime(),
            'updated_at' => fake()->unixTime(),
        ];
    }
}
