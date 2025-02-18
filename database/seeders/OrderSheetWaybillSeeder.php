<?php

namespace Database\Seeders;

use Cable8mm\OrderSheet\Enums\OrderSheetType;
use Cable8mm\OrderSheet\OrderSheet;
use Cable8mm\Waybill\Enums\ParcelService;
use Cable8mm\Waybill\Waybill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class OrderSheetWaybillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storage::disk('local')->makeDirectory('waybills');

        Waybill::of(ParcelService::Cj)
            ->path(storage_path('app/private/waybills'))
            ->save('order_sheet_waybill.pdf');

        OrderSheet::of(OrderSheetType::PlayautoType)
            ->count(10)
            ->header()
            ->path(storage_path('app/private/waybills'))
            ->xlsx('order_sheet_waybill_simple.xlsx');

        \App\Models\OrderSheetWaybill::factory()->count(10)->create();
    }
}
