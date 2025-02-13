<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\GoodResource;
use App\Models\Good;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GoodController extends Controller
{
    /**
     * /good
     *
     * Get goods with paging
     */
    public function index()
    {
        $items = Good::latest()->paginate(request('count', 12));

        return GoodResource::collection($items);
    }

    /**
     * /good/{good}
     *
     * Get a good
     */
    public function show(Good $good)
    {
        return new GoodResource($good);
    }

    /**
     * /good/{masterCode}
     *
     * Get a good by master code
     */
    public function showByMasterCode(string $masterCode)
    {
        Validator::make(
            ['masterCode' => $masterCode],
            ['masterCode' => 'required|string']
        );

        try {
            $good = Good::where('master_code', $masterCode)->firstOrFail();
        } catch (Exception $e) {
            return response()->json([
                'message' => __('The given barcode was invalid.'),
            ], 400);
        }

        return new GoodResource($good);
    }

    /**
     * /good/barcode/{barcode}
     *
     * Get a good by barcode
     */
    public function showByBarcode(Request $request, Good $good, string $barcode)
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
            $good = $good->where('barcode', $barcode)->firstOrFail();
        } catch (Exception $e) {
            return response()->json([
                'message' => __('The given barcode was invalid.'),
            ], 400);
        }

        return new GoodResource($good);
    }

    /**
     * /good/{good}/balance
     *
     * Add or subtract a inventory amount
     *
     * @param  \App\Models\Good  $good  The good model
     * @return GoodResource|\Illuminate\Http\JsonResponse The good resource if successful, otherwise returns a json response
     */
    public function balance(Request $request, Good $good)
    {
        $validated = $request->validate([
            'amount' => 'required|integer|not_in:0',
        ]);

        if ($good->inventory($validated['amount'])) {
            return new GoodResource($good);
        }

        return response()->json([
            'message' => __('Internal Server Error.'),
        ], 500);
    }

    /**
     * /good/{good}/balance-by-barcode
     *
     * Add or subtract a inventory amount
     *
     * @param  string  $barcode  The barcode of a good
     * @return GoodResource|\Illuminate\Http\JsonResponse The good resource if successful, otherwise returns a json response
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
            $good = Good::where('barcode', $barcode)->firstOrFail();
        } catch (Exception $e) {
            return response()->json([
                'message' => __('The given barcode was invalid.'),
            ], 400);
        }

        if ($good->inventory($validated['amount'])) {
            return new GoodResource($good);
        }

        return response()->json([
            'message' => __('Internal Server Error.'),
        ], 500);
    }
}
