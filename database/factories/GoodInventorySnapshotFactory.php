<?php

namespace Database\Factories;

use App\Enums\SafeClass;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GoodInventorySnapshotFactory extends Factory
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
            'good_id' => fake()->randomNumber(1) + 1,
            'playauto_master_code' => 'PM'.fake()->randomNumber(3, true),
            'inventory' => fake()->randomNumber(2) + 1,
            'safe_class' => fake()->randomElement(SafeClass::names()),
            'type' => fake()->randomElement(Status::names()),
        ];
    }
}
