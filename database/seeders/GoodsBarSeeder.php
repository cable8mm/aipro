<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GoodsBarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\GoodsBar::factory()->count(10)->create();
    }
}
