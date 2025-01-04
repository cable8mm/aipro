<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GoodWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\GoodWork::factory()->count(10)->create();
    }
}
