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
            BoxSeeder::class,
            OrderSheetWaybillSeeder::class,
            LocationSeeder::class,
            BoxSupplierSeeder::class,
            SupplierSeeder::class,
            AlertEmailSeeder::class,
            BoxInventoryHistorySeeder::class,
            BoxManualWarehousingSeeder::class,
            BoxPurchaseOrderSeeder::class,
            ChannelFeeSeeder::class,
            ChannelSeeder::class,
            HelpTipSeeder::class,
            IssueCommentSeeder::class,
            IssueSeeder::class,
            MismatchedOrderShipmentSeeder::class,
            NaverCategorySeeder::class,
            OptionGoodSeeder::class,    // This must be over `OptionGoodOptionSeeder::class`
            // OrderSeeder::class,
            PlayautoGoodSeeder::class,
            PriceCoefficientSeeder::class,
            PromotionCodeSeeder::class,
            PurchaseOrderSeeder::class,
            RegisterGoodRequestSeeder::class,
            RegisterOptionGoodRequestSeeder::class,
            SettingSeeder::class,
            ShutdownGoodSeeder::class,
            SupplierItemSeeder::class,
            BoxPurchaseOrderItemSeeder::class,
            ItemSeeder::class,
            OptionGoodOptionSeeder::class,
            PurchaseOrderItemSeeder::class,
            SupplierItemManualWarehousingSeeder::class,
            InventoryHistorySeeder::class,
            PlayautoCategorySeeder::class,
            ItemInventorySnapshotSeeder::class,
            // OrderShipmentSeeder::class,
            ItemManualWarehousingSeeder::class,
            BarcodeCommandSeeder::class,
            RegisterImportFileSeeder::class,
            HelpfulFileSeeder::class,
            GoodSeeder::class,
            SetGoodSeeder::class,
            CustomerSeeder::class,
            RetailPurchaseSeeder::class,
            RetailPurchaseItemSeeder::class,
        ]);
    }
}
