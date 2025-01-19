<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Support\Barcode;
use Illuminate\Http\Request;

class GenerateBarcodeController extends Controller
{
    public function __invoke(Request $request)
    {
        $number = $request->get('number');

        return Barcode::factory($number)->render();
    }
}
