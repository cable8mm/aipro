<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
            OptionGoodSeeder::class,    // This must be over `OptionGoodOptionSeeder::class`
            // OrderSeeder::class,
            PriceCoefficientSeeder::class,
            PromotionCodeSeeder::class,
            PurchaseOrderSeeder::class,
            SettingSeeder::class,
            SupplierItemSeeder::class,
            BoxPurchaseOrderItemSeeder::class,
            ItemSeeder::class,
            OptionGoodOptionSeeder::class,
            PurchaseOrderItemSeeder::class,
            InventoryHistorySeeder::class,
            // OrderShipmentSeeder::class,
            ItemManualWarehousingSeeder::class,
            BarcodeCommandSeeder::class,
            HelpfulFileSeeder::class,
            GoodSeeder::class,
            SetGoodSeeder::class,
            CustomerSeeder::class,
            RetailPurchaseSeeder::class,
            RetailPurchaseItemSeeder::class,
            BoxInventoryHistorySeeder::class,
        ]);
    }
}
