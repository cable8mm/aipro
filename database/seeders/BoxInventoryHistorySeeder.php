<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BoxInventoryHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\BoxInventoryHistory::factory()->count(10)->create();
    }
}
