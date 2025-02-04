<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class OrderSheetInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Storage::disk('local')->makeDirectory('invoices');

        File::copy(
            base_path('tests/files/invoices/order_sheet_invoice.pdf'),
            storage_path('app/private/invoices/order_sheet_invoice.pdf')
        );

        File::copy(
            base_path('tests/files/invoices/order_sheet_invoice_simple.xlsx'),
            storage_path('app/private/invoices/order_sheet_invoice_simple.xlsx')
        );

        \App\Models\OrderSheetInvoice::factory()->count(10)->create();
    }
}
