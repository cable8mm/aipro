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
            AlertEmailSeeder::class,
            B2bGoodSeeder::class,
            BoxInventoryHistorySeeder::class,
            BoxManualWarehousingSeeder::class,
            BoxOrderBoxSeeder::class,
            BoxOrderSeeder::class,
            BoxSupplierSeeder::class,
            BoxSeeder::class,
            BundledGoodSeeder::class,
            ChannelFeeSeeder::class,
            ChannelGoodSeeder::class,
            ChannelSeeder::class,
            GoodInventorySnapshotSeeder::class,
            GoodManualWarehousingSeeder::class,
            GoodWorkSeeder::class,
            GoodSeeder::class,
            GoodsBarSeeder::class,
            HelpTipSeeder::class,
            InventoryHistorySeeder::class,
            IssueCommentSeeder::class,
            IssueSeeder::class,
            MismatchedOrderShipmentSeeder::class,
            NaverCategorySeeder::class,
            OptionGoodOptionSeeder::class,
            OptionGoodSeeder::class,
            OrderSheetInvoiceSeeder::class,
            OrderSeeder::class,
            PlacingOrderGoodSeeder::class,
            PlacingOrderSeeder::class,
            PlayautoGoodSeeder::class,
            PlayautoMasterCodeSeeder::class,
            PriceCoefficientSeeder::class,
            PromotionCodeSeeder::class,
            RegisterGoodRequestSeeder::class,
            RegisterOptionGoodRequestSeeder::class,
            SetGoodSeeder::class,
            SettingSeeder::class,
            ShutdownGoodSeeder::class,
            SupplierGoodManualWarehousingSeeder::class,
            SupplierGoodSeeder::class,
            SupplierSeeder::class,
            WaybillSeeder::class,
        ]);
    }
}
