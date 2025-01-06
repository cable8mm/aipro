<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderSheetInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\OrderSheetInvoice::factory()->count(10)->create();
    }
}
