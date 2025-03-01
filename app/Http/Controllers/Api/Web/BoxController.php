<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\BoxResource;
use App\Models\Box;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BoxController extends Controller
{
    /**
     * /api/web/box/{sku}
     *
     * Get a box by sku
     */
    public function showBySku(string $sku)
    {
        $validated = Validator::validate(
            ['sku' => $sku],
            ['sku' => [
                Rule::exists('boxes', 'sku'),
            ]]
        );

        $box = Box::where('sku', $validated['sku'])->firstOrFail();

        return new BoxResource($box);
    }
}
