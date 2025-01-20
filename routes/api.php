<?php

use App\Http\Controllers\API\GenerateBarcodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/generate-barcode/{barcode_number}', GenerateBarcodeController::class);
