<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SetGoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $goodCount = rand(1, 5);
            $setGood = \App\Models\SetGood::factory()
                ->state([
                    'good_count' => $goodCount,
                ])
                ->create();

            for ($j = 1; $j <= $goodCount; $j++) {
                $quantity = rand(1, 12);
                $setGood->items()->attach($j, [
                    'quantity' => $quantity,
                ]);
            }
        }
    }
}
