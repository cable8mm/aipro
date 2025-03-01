<?php

namespace App\Http\Controllers\Api\Web;

use App\Enums\ManualInventoryAdjustmentType;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemManualWarehousing as ResourcesItemManualWarehousing;
use App\Models\ItemManualWarehousing;
use Illuminate\Http\Request;
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
            'item_id' => 'required|not_in:0|exists:items,id',
            'amount' => 'required|integer|not_in:0',
            'type' => [
                'required',
                Rule::enum(ManualInventoryAdjustmentType::class),
            ],
            'memo' => 'nullable|string',
        ]);

        return new ResourcesItemManualWarehousing(ItemManualWarehousing::create([
            'item_id' => $validated['item_id'],
            'amount' => $validated['amount'],
            'type' => ManualInventoryAdjustmentType::tryFrom($validated['type']),
            'memo' => $validated['memo'],
        ]));
    }
}
