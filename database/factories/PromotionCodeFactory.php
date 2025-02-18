<?php

namespace Database\Factories;

use App\Enums\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PromotionCodeFactory extends Factory
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
            'promotion_codable_id' => fake()->randomNumber(1) + 1,
            'promotion_codable_type' => fake()->randomElement(['App\Models\Item', 'App\Models\SetGood']), // change this to your model class name
            'memo' => fake()->randomElement(Site::values()).'용 프로모션 코드 입니다.',
            'started_at' => fake()->dateTime(),
            'finished_at' => fake()->dateTime(),
        ];
    }
}
