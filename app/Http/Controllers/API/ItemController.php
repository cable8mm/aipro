<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * /item
     *
     * Get items with paging
     */
    public function index()
    {
        $items = Item::latest()->paginate(request('count', 12));

        return ItemResource::collection($items);
    }

    /**
     * /item/{item}
     *
     * Get a item
     */
    public function show(Item $item)
    {
        return new ItemResource($item);
    }

    /**
     * /item/{masterCode}
     *
     * Get a item by master code
     */
    public function showByMasterCode(string $masterCode)
    {
        Validator::make(
            ['masterCode' => $masterCode],
            ['masterCode' => 'required|string']
        );

        try {
            $item = Item::where('master_code', $masterCode)->firstOrFail();
        } catch (Exception $e) {
            return response()->json([
                'message' => __('The given barcode was invalid.'),
            ], 400);
        }

        return new ItemResource($item);
    }

    /**
     * /item/barcode/{barcode}
     *
     * Get a item by barcode
     */
    public function showByBarcode(Request $request, Item $item, string $barcode)
    {
        Validator::make(
            ['barcode' => $barcode],
            ['barcode' => 'required|string']
        );

        $validator = Validator::make($request->all(), [
            'barcode' => 'required|integer|not_in:0',
        ]);

        $validated = $validator->validated();

        try {
            $item = $item->where('barcode', $barcode)->firstOrFail();
        } catch (Exception $e) {
            return response()->json([
                'message' => __('The given barcode was invalid.'),
            ], 400);
        }

        return new ItemResource($item);
    }

    /**
     * /item/{item}/balance
     *
     * Add or subtract a inventory amount
     *
     * @param  \App\Models\Item  $item  The good model
     * @return ItemResource|\Illuminate\Http\JsonResponse The good resource if successful, otherwise returns a json response
     */
    public function balance(Request $request, Item $item)
    {
        $validated = $request->validate([
            'amount' => 'required|integer|not_in:0',
        ]);

        if ($item->inventory($validated['amount'])) {
            return new ItemResource($item);
        }

        return response()->json([
            'message' => __('Internal Server Error.'),
        ], 500);
    }

    /**
     * /item/{item}/balance-by-barcode
     *
     * Add or subtract a inventory amount
     *
     * @param  string  $barcode  The barcode of a item
     * @return ItemResource|\Illuminate\Http\JsonResponse The good resource if successful, otherwise returns a json response
     */
    public function balanceByBarcode(Request $request, string $barcode)
    {
        Validator::make(
            ['barcode' => $barcode],
            ['barcode' => 'required|string']
        );

        $validated = $request->validate([
            'amount' => 'required|integer|not_in:0',
        ]);

        try {
            $item = Item::where('barcode', $barcode)->firstOrFail();
        } catch (Exception $e) {
            return response()->json([
                'message' => __('The given barcode was invalid.'),
            ], 400);
        }

        if ($item->inventory($validated['amount'])) {
            return new ItemResource($item);
        }

        return response()->json([
            'message' => __('Internal Server Error.'),
        ], 500);
    }
}
