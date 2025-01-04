<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PriceCoefficientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\PriceCoefficient::factory()->count(10)->create();
    }
}
