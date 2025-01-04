<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GoodInventorySnapshotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\GoodInventorySnapshot::factory()->count(10)->create();
    }
}
