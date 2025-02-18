<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemManualWarehousingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ItemManualWarehousing::factory()->count(10)->create();
    }
}
