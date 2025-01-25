<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BoxPlacingOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\BoxPlacingOrder::factory()->count(10)->create();
    }
}
