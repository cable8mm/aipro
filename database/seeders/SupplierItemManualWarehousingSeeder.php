<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SupplierItemManualWarehousingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SupplierItemManualWarehousing::factory()->count(10)->create();
    }
}
