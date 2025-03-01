<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    /**
     * /api/web/item
     *
     * Get items with paging
     */
    public function index(Request $request)
    {
        $items = Item::latest()
            ->paginate(
                perPage: $request->integer('per_page', 12),
                page: $request->integer('page', 1)
            );

        return ItemResource::collection($items);
    }

    /**
     * /api/web/item/{id}
     *
     * Get a item
     */
    public function show(Item $item)
    {
        return new ItemResource($item);
    }

    /**
     * /api/web/item/sku/{sku}
     *
     * Get a item From master code
     */
    public function showFromSku(string $sku)
    {
        Validator::make(
            ['sku' => $sku],
            ['sku' => [
                'required',
                'string',
                Rule::exists('items', 'sku'),
            ]],
        );

        return new ItemResource(
            Item::where('sku', $sku)->firstOrFail()
        );
    }

    /**
     * /api/web/item/barcode/{barcode}
     *
     * Get a item From barcode
     */
    public function showFromBarcode(Item $item, string $barcode)
    {
        Validator::validate(
            ['barcode' => $barcode],
            ['barcode' => [
                'required',
                'string',
                Rule::exists('items', 'barcode'),
            ]],
        );

        return new ItemResource(
            $item->where('barcode', $barcode)->firstOrFail()
        );
    }
}
