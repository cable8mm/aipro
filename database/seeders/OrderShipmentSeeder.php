<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\OrderShipment::factory()->count(10)->create();
    }
}
