<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlacingOrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\PlacingOrderItem::factory()->count(10)->create();
    }
}
