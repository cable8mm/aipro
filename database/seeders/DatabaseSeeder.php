<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            WarehouseSeeder::class,
            OrderSheetWaybillSeeder::class,
            LocationSeeder::class,
            BoxSupplierSeeder::class,
            BoxSeeder::class,
            SupplierSeeder::class,
            AlertEmailSeeder::class,
            BoxManualWarehousingSeeder::class,
            BoxPurchaseOrderSeeder::class,
            HelpTipSeeder::class,
            MismatchedOrderShipmentSeeder::class,
            // OrderSeeder::class,
            PriceCoefficientSeeder::class,
            PromotionCodeSeeder::class,
            PurchaseOrderSeeder::class,
            SettingSeeder::class,
            SupplierItemSeeder::class,
            BoxPurchaseOrderItemSeeder::class,
            ItemSeeder::class,
            PurchaseOrderItemSeeder::class,
            InventoryHistorySeeder::class,
            // OrderShipmentSeeder::class,
            ItemManualWarehousingSeeder::class,
            BarcodeCommandSeeder::class,
            HelpfulFileSeeder::class,
            GoodSeeder::class,
            SetGoodSeeder::class,
            OptionGoodSeeder::class,    // This must be over `OptionGoodOptionSeeder::class`
            OptionGoodOptionSeeder::class,
            CustomerSeeder::class,
            RetailPurchaseSeeder::class,
            RetailPurchaseItemSeeder::class,
            BoxInventoryHistorySeeder::class,
        ]);

        Artisan::call('aipro:create-nova-account');
    }
}
