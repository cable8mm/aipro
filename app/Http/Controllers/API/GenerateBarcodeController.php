<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Support\Barcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class GenerateBarcodeController extends Controller
{
    public function __invoke(Request $request, string $barcode_number)
    {
        return Response::make(
            Barcode::factory($barcode_number)->render(),
            200,
            ['Content-Type' => 'image/png']
        );
    }
}
