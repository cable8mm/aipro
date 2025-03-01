<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Support\Barcode;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

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
        Validator::validate(
            ['barcode' => $barcode],
            ['barcode' => [
                'required',
                'string',
            ]]
        );

        return Response::make(
            Barcode::factory($barcode)->render(),
            200,
            ['Content-Type' => 'image/png']
        );
    }
}
