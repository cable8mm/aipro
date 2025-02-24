<?php

namespace Database\Seeders;

use Cable8mm\GoodCode\LocationCode;
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
                'name' => '센터'.$i.'호',
                'code' => LocationCode::of(''),
            ])->create();
        }

        \App\Models\Box::inRandomOrder()->first()->update([
            'is_default' => true,
        ]);
    }
}
