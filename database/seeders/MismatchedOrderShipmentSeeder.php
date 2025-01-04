<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MismatchedOrderShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\MismatchedOrderShipment::factory()->count(10)->create();
    }
}
