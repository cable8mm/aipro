<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ChannelGoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'playauto_master_code' => fake()->text(190),
            'goods_bar' => fake()->text(190),
            'coupang_price' => fake()->randomNumber(),
            'coupang_sale_status' => fake()->text(100),
            'coupang_approved' => fake()->text(100),
            'coupang_inventory' => fake()->randomNumber(),
            'kakaotalk_price' => fake()->randomNumber(),
            'kakaotalk_sale_status' => fake()->text(100),
            'kakaotalk_inventory' => fake()->randomNumber(),
            'ssg_price' => fake()->randomNumber(),
            'ssg_sale_status' => fake()->text(100),
            'ssg_inventory' => fake()->randomNumber(),
            '11st_price' => fake()->randomNumber(),
            '11st_sale_status' => fake()->text(100),
            '11st_inventory' => fake()->randomNumber(),
            'gmarket_price' => fake()->randomNumber(),
            'gmarket_sale_status' => fake()->text(100),
            'gmarket_inventory' => fake()->randomNumber(),
            'storefarm_channel' => fake()->text(100),
            'storefarm_price' => fake()->randomNumber(),
            'storefarm_sale_status' => fake()->text(100),
            'storefarm_inventory' => fake()->randomNumber(),
            'auction_price' => fake()->randomNumber(),
            'auction_sale_status' => fake()->text(100),
            'auction_inventory' => fake()->randomNumber(),
            'wemake_price' => fake()->randomNumber(),
            'wemake_sale_status' => fake()->text(100),
            'gift_price' => fake()->randomNumber(),
            'gift_sale_status' => fake()->text(100),
            'gift_inventory' => fake()->randomNumber(),
        ];
    }
}
