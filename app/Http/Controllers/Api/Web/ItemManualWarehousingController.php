<?php

namespace App\Http\Controllers\Api\Web;

use App\Enums\ItemManualWarehousingType;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemManualWarehousing as ResourcesItemManualWarehousing;
use App\Models\Item;
use App\Models\ItemManualWarehousing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ItemManualWarehousingController extends Controller
{
    /**
     * /api/web/item-manual-warehousings
     *
     * Add or subtract a inventory amount
     *
     * @param  \App\Models\Item  $item  The good model
     * @return ItemResource|\Illuminate\Http\JsonResponse The good resource if successful, otherwise returns a json response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => [
                'required',
                'not_in:0',
                'exists:items,id',
            ],
            'amount' => [
                'required',
                'integer',
                'not_in:0',
            ],
            'type' => [
                'required',
                Rule::enum(ItemManualWarehousingType::class),
            ],
            'memo' => [
                'nullable',
                'string',
            ],
        ]);

        return new ResourcesItemManualWarehousing(ItemManualWarehousing::create([
            'item_id' => $validated['item_id'],
            'amount' => $validated['amount'],
            'type' => ItemManualWarehousingType::tryFrom($validated['type']),
            'memo' => $validated['memo'],
        ]));
    }

    /**
     * /api/web/item-manual-warehousings/barcode/{barcode}
     *
     * Add or subtract a inventory amount
     *
     * @param  string  $barcode  The barcode of a item
     * @return ItemResource|\Illuminate\Http\JsonResponse The good resource if successful, otherwise returns a json response
     */
    public function storeFromBarcode(Request $request, string $barcode)
    {
        $validated = Validator::validate(
            ['barcode' => $barcode],
            ['barcode' => [
                'required',
                'string',
                Rule::exists('items', 'barcode'),
            ]]
        );

        $validated += $request->validate([
            'amount' => [
                'required',
                'integer',
                'not_in:0',
            ],
            'type' => [
                'required',
                Rule::enum(ItemManualWarehousingType::class),
            ],
            'memo' => [
                'nullable',
                'string',
            ],
        ]);

        $item = Item::where('barcode', $validated['barcode'])->firstOrFail();

        return new ResourcesItemManualWarehousing($item->itemManualWarehousings()->create([
            'amount' => $validated['amount'],
            'type' => ItemManualWarehousingType::tryFrom($validated['type']),
            'memo' => $validated['memo'],
        ]));
    }
}
