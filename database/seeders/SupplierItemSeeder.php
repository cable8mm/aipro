<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SupplierItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SupplierItem::factory()->count(10)->create();
    }
}
