<?php

namespace Database\Seeders;

use Cable8mm\GoodCode\Sku;
use Illuminate\Database\Seeder;

class BoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 11; $i++) {
            \App\Models\Box::factory(1, [
                'name' => __('Box Level :count', ['count' => $i]),
                'sku' => Sku::of($i, prefix: 'BOX'),
            ])->create();
        }

        \App\Models\Box::inRandomOrder()->first()->update([
            'is_default' => true,
        ]);
    }
}
