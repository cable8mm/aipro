<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Support\Barcode;
use Illuminate\Support\Facades\Response;

class GenerateBarcodeController extends Controller
{
    /**
     * /api/web/generate-barcode/{barcode}
     *
     * Generates a new barcode image
     *
     * @param  string  $barcode  The barcode number. Example: "90000001010018"
     * @return \Illuminate\Http\Response A response object representing the requested barcode image
     */
    public function __invoke(string $barcode)
    {
        return Response::make(
            Barcode::factory($barcode)->render(),
            200,
            ['Content-Type' => 'image/png']
        );
    }
}
