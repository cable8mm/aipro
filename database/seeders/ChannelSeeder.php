<?php

namespace Database\Seeders;

use App\Enums\Channel;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (($handle = fopen(base_path('docs/csv/channels.csv'), 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                \App\Models\Channel::factory(1, [
                    'author_id' => fake()->randomNumber(1) + 1,
                    'name' => $data[2],
                    'playauto_site' => $data[3],
                    'siteid' => $data[4],
                    'fee_rate' => empty($data[5]) ? null : $data[5],
                    'total_good_count' => empty($data[6]) ? null : $data[6],
                    'total_sale_good_count' => empty($data[7]) ? null : $data[7],
                    'total_sold_out_good_count' => empty($data[8]) ? null : $data[8],
                    'total_no_sale_good_count' => empty($data[9]) ? null : $data[9],
                    'filepath' => $data[10],
                    'last_processed_at' => empty($data[11]) ? null : $data[6],
                    'memo' => $data[12],
                    'is_active' => $data[13],
                    'status' => Channel::getName($data[14]),
                ])->create();
            }
            fclose($handle);
        }
    }
}
