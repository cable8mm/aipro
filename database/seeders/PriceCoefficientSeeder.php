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
        if (($handle = fopen(base_path('docs/csv/price_coefficients.csv'), 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                \App\Models\PriceCoefficient::factory(1, [
                    'id' => $data[0],
                    'center_class' => $data[1],
                    'start_price' => $data[2],
                    'end_price' => $data[3],
                    'coefficient' => $data[4],
                ])->create();
            }
            fclose($handle);
        }
    }
}
