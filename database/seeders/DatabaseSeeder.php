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
            BoxInventoryHistorySeeder::class,
            BoxManualWarehousingSeeder::class,
            BoxOrderBoxSeeder::class,
            BoxOrderSeeder::class,
            BoxSupplierSeeder::class,
            BoxSeeder::class,
            ChannelFeeSeeder::class,
            ChannelGoodSeeder::class,
            ChannelSeeder::class,
            GoodInventorySnapshotSeeder::class,
            GoodManualWarehousingSeeder::class,
            GoodSeeder::class,
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
            OrderShipmentSeeder::class,
            PlacingOrderGoodSeeder::class,
            PlacingOrderSeeder::class,
            PlayautoCategorySeeder::class,
            PlayautoGoodSeeder::class,
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
        ]);
    }
}
