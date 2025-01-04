<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OptionGoodOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\OptionGoodOption::factory()->count(10)->create();
    }
}
