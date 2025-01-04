<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SupplierGoodManualWarehousingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SupplierGoodManualWarehousing::factory()->count(10)->create();
    }
}
