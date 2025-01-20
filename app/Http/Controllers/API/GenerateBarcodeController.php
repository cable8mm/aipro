<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Support\Barcode;
use Illuminate\Support\Facades\Response;

class GenerateBarcodeController extends Controller
{
    /**
     * Generate Barcode
     *
     * @param  string  $barcodeNumber  The barcode number. Example: "90000001010018"
     * @return \Illuminate\Http\Response A response object representing the requested barcode image
     */
    public function __invoke(string $barcodeNumber)
    {
        return Response::make(
            Barcode::factory($barcodeNumber)->render(),
            200,
            ['Content-Type' => 'image/png']
        );
    }
}
