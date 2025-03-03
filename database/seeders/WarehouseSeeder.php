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
                'id' => LocationCode::of(warehouse: 'A'.$i),
                'description' => __('Warehouse')." $i",
            ])->create();
        }
    }
}
