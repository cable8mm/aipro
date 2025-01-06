<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Good::factory()->count(10)->create();
    }
}
