<?php

namespace Database\Seeders;

use Cable8mm\GoodCode\Enums\GoodCodeType;
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
                'goods_code' => GoodCodeType::OPTION->prefix().$i,
            ])->create();
        }
    }
}
