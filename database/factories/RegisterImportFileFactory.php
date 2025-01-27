<?php

namespace Database\Factories;

use App\Enums\ImportType;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RegisterImportFile>
 */
class RegisterImportFileFactory extends Factory
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
            'type' => fake()->randomElement(ImportType::names()),
            'memo' => fake()->realText(30),
            'attachment' => fake()->uuid().'.xlsx',
            'attachment_name' => fake()->word().'.xlsx',
            'attachment_size' => fake()->randomNumber(8, true),
            'status' => fake()->randomElement(Status::names()),
        ];
    }
}
