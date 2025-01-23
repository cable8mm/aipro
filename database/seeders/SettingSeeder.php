<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'OPEN_MARKET_MINIMUM_INVENTORY',
                'value' => 2,
                'memo' => '이 수치 미만(포함 안됨)일 경우 품절처리 됨',
            ],
            [
                'key' => 'GOAL_SUM_OF_COST_PRICE',
                'value' => 20000000,
                'memo' => '목표 매입가 합',
            ],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::factory()->create($setting);
        }
    }
}
