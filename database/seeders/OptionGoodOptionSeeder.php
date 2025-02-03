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
        for ($i = 1; $i <= 100; $i++) {
            \App\Models\OptionGoodOption::factory()->state([
                'sort_order' => $i,
            ])->create();
        }
    }
}
