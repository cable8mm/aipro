<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemInventorySnapshotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ItemInventorySnapshot::factory()->count(10)->create();
    }
}
