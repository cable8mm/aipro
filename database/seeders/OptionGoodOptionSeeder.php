<?php

namespace Database\Seeders;

use App\Models\OptionGood;
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

        OptionGood::findGoodsCode('OPT8')->optionGoodOptions()->first()->update(['name' => '데이지(닭)']);

        OptionGood::findGoodsCode('OPT4')->optionGoodOptions()->first()->update(['name' => '미트앤피쉬 레귤러 12kg']);
    }
}
