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
        for ($i = 1; $i <= 10; $i++) {
            \App\Models\Good::factory()->state([
                'master_code' => $i,
            ])->create();
        }
    }
}
