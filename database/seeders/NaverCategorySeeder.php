<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NaverCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\NaverCategory::factory()->count(10)->create();
    }
}
