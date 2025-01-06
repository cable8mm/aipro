<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PromotionCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\PromotionCode::factory()->count(10)->create();
    }
}
