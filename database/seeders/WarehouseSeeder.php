<?php

namespace Database\Seeders;

use App\Models\Warehouse;
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
            Warehouse::factory()->state([
                'code' => LocationCode::of(warehouse: 'W'.$i),
                'description' => __('Warehouse')." W$i",
            ])->create();
        }
    }
}
