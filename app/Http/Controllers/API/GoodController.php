<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\GoodResource;
use App\Models\Good;

class GoodController extends Controller
{
    /**
     * /good
     *
     * Get goods with paging
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $items = Good::latest()->paginate(request('count', 12));

        return GoodResource::collection($items);
    }

    /**
     * /good/{id}
     *
     * Get a good
     */
    public function show(Good $good): \Illuminate\Http\Resources\Json\JsonResource
    {
        return new GoodResource($good);
    }

    /**
     * /good/{master_code}
     *
     * Get a good by master code
     */
    public function showByMasterCode(string $showByMasterCode): \Illuminate\Http\Resources\Json\JsonResource
    {
        $good = Good::where('master_code', $showByMasterCode)->firstOrFail();

        return new GoodResource($good);
    }

    /**
     * /good/{barcode}
     *
     * Get a good by barcode
     */
    public function showByBarcode(string $barcode): \Illuminate\Http\Resources\Json\JsonResource
    {
        $good = Good::where('barcode', $barcode)->firstOrFail();

        return new GoodResource($good);
    }
}
