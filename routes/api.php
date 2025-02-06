<?php

use App\Http\Controllers\API\GenerateBarcodeController;
use App\Http\Controllers\API\PrintController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/generate-barcode/{barcodeNumber}', GenerateBarcodeController::class);

Route::get('/print/order-sheet-invoice/{orderSheetInvoice}', [PrintController::class, 'orderSheetInvoice']);
Route::get('/print/order-shipment/{orderShipment}', [PrintController::class, 'orderShipment']);
