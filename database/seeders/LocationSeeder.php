<?php

namespace Database\Seeders;

use App\Models\Location;
use Cable8mm\GoodCode\LocationCode;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            Location::factory()->state([
                'code' => LocationCode::of(warehouse: 'A'.$i),
                'description' => __('Location')." A$i",
            ])->create();
        }
    }
}
