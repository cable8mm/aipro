<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlacingOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\PlacingOrder::factory()->count(10)->create();
    }
}
