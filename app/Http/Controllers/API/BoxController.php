<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BoxResource;
use App\Models\Box;

class BoxController extends Controller
{
    /**
     * /box/{code}
     *
     * Get a box by code
     */
    public function showByCode(string $code): \Illuminate\Http\Resources\Json\JsonResource
    {
        $box = Box::where('code', $code)->firstOrFail();

        return new BoxResource($box);
    }
}
