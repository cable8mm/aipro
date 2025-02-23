<?php

namespace Database\Seeders;

use Cable8mm\GoodCode\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            \App\Models\Location::create([
                'id' => Location::of(warehouse: 'A'.$i, rack: 'R1'),
                'warehouse_id' => Location::of(warehouse: 'A'.$i),
                'description' => __('Warehouse')." A$i ".__('Rack').' R1',
            ]);
        }
    }
}
