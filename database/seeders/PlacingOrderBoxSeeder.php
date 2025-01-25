<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlacingOrderBoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\PlacingOrderBox::factory()->count(10)->create();
    }
}
