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
            'id' => fake()->numerify(),
            'ct_order_sheet_invoice_id' => fake()->randomNumber(),
            'orderNo' => fake()->text(),
            'site' => fake()->text(),
            'masterGoodsCd' => fake()->text(),
            'goodsNm' => fake()->text(),
            'option' => fake()->text(),
            'json' => fake()->paragraph(),
            'cms_maestro_id' => fake()->randomNumber(),
            'status' => fake()->text(),
            'created' => fake()->dateTime(),
            'modified' => fake()->dateTime(),
        ];
    }
}
