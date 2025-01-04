<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InventoryHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\InventoryHistory::factory()->count(10)->create();
    }
}
