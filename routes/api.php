<?php

use App\Http\Controllers\API\BoxController;
use App\Http\Controllers\API\GenerateBarcodeController;
use App\Http\Controllers\API\GoodController;
use App\Http\Controllers\API\PrintController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/generate-barcode/{barcodeNumber}', GenerateBarcodeController::class);

Route::get('/print/order-sheet-invoice/{orderSheetInvoice}', [PrintController::class, 'orderSheetInvoice']);
Route::get('/print/order-shipment/{orderShipment}', [PrintController::class, 'orderShipment']);
Route::get('/print/order/{order}', [PrintController::class, 'order']);

Route::get('/good', [GoodController::class, 'index']);
Route::get('/good/{good}', [GoodController::class, 'show']);
Route::get('/good/master-code/{masterCode}', [GoodController::class, 'showByMasterCode']);
Route::get('/good/barcode/{barcode}', [GoodController::class, 'showByBarcode']);
Route::post('/good/{good}/balance', [GoodController::class, 'balance']);
Route::post('/good/{good}/balance-by-barcode', [GoodController::class, 'balanceByBarcode']);

Route::get('/box/{code}', [BoxController::class, 'showByCode']);
