<?php

namespace Database\Seeders;

use Cable8mm\GoodCode\LocationCode;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            \App\Models\Warehouse::create([
                'id' => LocationCode::of(warehouse: 'A'.$i),
                'description' => __('Warehouse')." $i",
            ]);
        }
    }
}
