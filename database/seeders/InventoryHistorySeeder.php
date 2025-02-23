<?php

namespace Database\Seeders;

use App\Models\OrderShipment;
use App\Models\RetailPurchaseItem;
use Illuminate\Database\Seeder;

class InventoryHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parents = [
            RetailPurchaseItem::class,
            OrderShipment::class,
        ];

        foreach ($parents as $parent) {
            $parent::all()->each(function ($parent) {
                /**
                 * @var \App\Models\Item $item
                 */
                $item = $parent->item;
                $inventory = fake()->numberBetween(-20, 20);
                $inventory = $inventory == 0 ? 1 : $inventory;

                $item->plusminus($inventory, $parent::class, $parent->id);
            });
        }
    }
}
