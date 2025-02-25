<?php

namespace Database\Seeders;

use Cable8mm\GoodCode\Sku;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            \App\Models\Item::factory()->state([
                'sku' => Sku::of($i),
            ])->create();
        }
    }
}
