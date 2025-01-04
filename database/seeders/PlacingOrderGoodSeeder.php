<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlacingOrderGoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\PlacingOrderGood::factory()->count(10)->create();
    }
}
