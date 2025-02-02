<?php

namespace Database\Seeders;

use Cable8mm\GoodCodeParser\Parsers\OptionGood;
use Illuminate\Database\Seeder;

class OptionGoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            \App\Models\OptionGood::factory()->state([
                'master_code' => OptionGood::PREFIX.$i,
            ])->create();
        }
    }
}
