<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\ItemManualWarehousing;
use Illuminate\Database\Seeder;

class InventoryHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::all()->each(function ($item) {
            $item->plusminus(1000, ItemManualWarehousing::class, $item->id);
        });

        $parents = [
            \App\Models\RetailPurchaseItem::class,
            \App\Models\OrderShipment::class,
        ];

        foreach ($parents as $parent) {
            $parent::all()->each(function ($model) {
                /**
                 * @var \App\Models\Item $item
                 */
                $item = $model->item;
                $inventory = fake()->numberBetween(-20, 20);
                $inventory = $inventory == 0 ? 1 : $inventory;

                $item->plusminus($inventory, get_class($model), $model->id);
            });
        }
    }
}
