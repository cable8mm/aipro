<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RegisterOptionGoodRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\RegisterOptionGoodRequest::factory()->count(10)->create();
    }
}
