<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\BoxManualWarehousing;
use App\Models\BoxPurchaseOrderItem;
use App\Models\Order;
use Illuminate\Database\Seeder;

class BoxInventoryHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Box::all()->each(function ($box) {
            $box->plusminus(1000, BoxManualWarehousing::class, $box->id);
        });

        $parents = [
            BoxPurchaseOrderItem::class,
            Order::class,
        ];

        foreach ($parents as $parent) {
            $parent::all()->each(function ($parent) {
                /**
                 * @var \App\Models\Box $box
                 */
                $box = $parent->box;
                $inventory = fake()->numberBetween(-20, 20);
                $inventory = $inventory == 0 ? 1 : $inventory;

                $box->plusminus($inventory, $parent::class, $parent->id);
            });
        }
    }
}
