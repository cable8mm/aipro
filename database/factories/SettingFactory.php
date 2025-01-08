<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => 'OPEN_MARKET_MINIMUM_INVENTORY',
            'value' => 2,
            'memo' => '이 수치 미만(포함 안됨)일 경우 품절처리 됨',
        ];
    }
}
