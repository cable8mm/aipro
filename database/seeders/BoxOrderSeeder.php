<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BoxOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\BoxOrder::factory()->count(10)->create();
    }
}
