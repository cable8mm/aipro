<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PickingZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\PickingZone::factory()->count(10)->create();
    }
}
