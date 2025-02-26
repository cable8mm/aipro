<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PriceCoefficientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (($handle = fopen(base_path('tests/files/price_coefficients.csv'), 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                \App\Models\PriceCoefficient::factory(1, [
                    'id' => $data[0],
                    'start_price' => $data[1],
                    'end_price' => $data[2],
                    'coefficient' => $data[3],
                ])->create();
            }
            fclose($handle);
        }
    }
}
