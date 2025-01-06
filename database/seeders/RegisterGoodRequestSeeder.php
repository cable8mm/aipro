<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RegisterGoodRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\RegisterGoodRequest::factory()->count(10)->create();
    }
}
