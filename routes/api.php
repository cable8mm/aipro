<?php

use App\Http\Controllers\API\BoxController;
use App\Http\Controllers\API\GenerateBarcodeController;
use App\Http\Controllers\API\GoodController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\OrderSheetWaybillController;
use App\Http\Controllers\API\OrderShipmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/generate-barcode/{barcodeNumber}', GenerateBarcodeController::class);

Route::put('/orders/{order}', [OrderController::class, 'update']);
Route::get('/orders/{order}/print', [OrderController::class, 'print']);
Route::get('/orders/{order}/waybill', [OrderController::class, 'waybill']);
Route::get('/orders/{order}/clear-order', [OrderController::class, 'clearOrder']);

Route::get('/order-sheet-waybills/{orderSheetWaybill}/print', [OrderSheetWaybillController::class, 'print']);

Route::get('/goods', [GoodController::class, 'index']);
Route::get('/goods/{good}', [GoodController::class, 'show']);
Route::get('/goods/sku/{sku}', [GoodController::class, 'showBySku']);
Route::get('/goods/barcode/{barcode}', [GoodController::class, 'showByBarcode']);
Route::post('/goods/{good}/balance', [GoodController::class, 'balance']);
Route::post('/goods/{good}/balance-by-barcode', [GoodController::class, 'balanceByBarcode']);

Route::get('/order-shipments/order/{id}', [OrderShipmentController::class, 'order']);
Route::get('/order-shipments/pause', [OrderShipmentController::class, 'pause']);

Route::get('/box/{code}', [BoxController::class, 'showByCode']);
