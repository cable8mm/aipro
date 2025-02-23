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
            AlertEmailSeeder::class,
            BarcodeCommandSeeder::class,
            BoxManualWarehousingSeeder::class,
            BoxPurchaseOrderSeeder::class,
            BoxPurchaseOrderItemSeeder::class,
            BoxSupplierSeeder::class,
            BoxSeeder::class,
            ChannelFeeSeeder::class,
            ChannelSeeder::class,
            ItemInventorySnapshotSeeder::class,
            ItemManualWarehousingSeeder::class,
            ItemSeeder::class,
            GoodSeeder::class,
            HelpTipSeeder::class,
            HelpfulFileSeeder::class,
            IssueCommentSeeder::class,
            IssueSeeder::class,
            MismatchedOrderShipmentSeeder::class,
            NaverCategorySeeder::class,
            OptionGoodSeeder::class,    // This must be over `OptionGoodOptionSeeder::class`
            OptionGoodOptionSeeder::class,
            OrderSheetWaybillSeeder::class,
            // OrderSeeder::class,
            // OrderShipmentSeeder::class,
            PickingZoneSeeder::class,
            PurchaseOrderSeeder::class,
            PurchaseOrderItemSeeder::class,
            PlayautoCategorySeeder::class,
            PlayautoGoodSeeder::class,
            PriceCoefficientSeeder::class,
            PromotionCodeSeeder::class,
            RegisterGoodRequestSeeder::class,
            RegisterImportFileSeeder::class,
            RegisterOptionGoodRequestSeeder::class,
            SetGoodSeeder::class,
            SettingSeeder::class,
            ShutdownGoodSeeder::class,
            SupplierItemManualWarehousingSeeder::class,
            SupplierItemSeeder::class,
            SupplierSeeder::class,
            CustomerSeeder::class,
            RetailPurchaseSeeder::class,
            RetailPurchaseItemSeeder::class,
            InventoryHistorySeeder::class,
            BoxInventoryHistorySeeder::class,
        ]);
    }
}
