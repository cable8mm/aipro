<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OptionGoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\OptionGood::factory()->count(10)->create();
    }
}
