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
            BoxInventoryHistorySeeder::class,
            BoxManualWarehousingSeeder::class,
            PlacingOrderBoxSeeder::class,
            BoxPlacingOrderSeeder::class,
            BoxSupplierSeeder::class,
            BoxSeeder::class,
            ChannelFeeSeeder::class,
            ChannelSeeder::class,
            GoodInventorySnapshotSeeder::class,
            GoodManualWarehousingSeeder::class,
            GoodSeeder::class,
            HelpTipSeeder::class,
            HelpfulFileSeeder::class,
            InventoryHistorySeeder::class,
            IssueCommentSeeder::class,
            IssueSeeder::class,
            MismatchedOrderShipmentSeeder::class,
            NaverCategorySeeder::class,
            OptionGoodSeeder::class,    // This must be over `OptionGoodOptionSeeder::class`
            OptionGoodOptionSeeder::class,
            OrderSheetInvoiceSeeder::class,
            // OrderSeeder::class,
            // OrderShipmentSeeder::class,
            PickingZoneSeeder::class,
            PlacingOrderGoodSeeder::class,
            PlacingOrderSeeder::class,
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
            SupplierGoodManualWarehousingSeeder::class,
            SupplierGoodSeeder::class,
            SupplierSeeder::class,
        ]);
    }
}
