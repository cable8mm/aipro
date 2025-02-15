<?php

namespace Database\Seeders;

use Cable8mm\OrderSheet\Enums\OrderSheetType;
use Cable8mm\OrderSheet\OrderSheet;
use Cable8mm\Waybill\Enums\ParcelService;
use Cable8mm\Waybill\Waybill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class OrderSheetInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storage::disk('local')->makeDirectory('invoices');

        Waybill::of(ParcelService::Cj)
            ->path(storage_path('app/private/invoices'))
            ->save('order_sheet_invoice.pdf');

        OrderSheet::of(OrderSheetType::PlayautoType)
            ->count(10)
            ->header()
            ->path(storage_path('app/private/invoices'))
            ->xlsx('order_sheet_invoice_simple.xlsx');

        \App\Models\OrderSheetInvoice::factory()->count(10)->create();
    }
}
