<?php

use App\Http\Controllers\Api\BoxController;
use App\Http\Controllers\Api\GenerateBarcodeController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderSheetWaybillController;
use App\Http\Controllers\Api\OrderShipmentController;
use Illuminate\Support\Facades\Route;

Route::get('/generate-barcode/{barcode}', GenerateBarcodeController::class)->name('generate-barcode');

Route::put('/orders/{order}', [OrderController::class, 'update']);
Route::get('/orders/{order}/print', [OrderController::class, 'print'])->name('orders.print')->middleware('auth:sanctum');
Route::get('/orders/{order}/waybill', [OrderController::class, 'waybill']);
Route::get('/orders/{order}/clear-order', [OrderController::class, 'clearOrder']);
Route::get('/orders/{waybill_numbers}/order-shipments', [OrderController::class, 'orderShipments']);

Route::get('/order-sheet-waybills/{order_sheet_waybill}/print', [OrderSheetWaybillController::class, 'print'])->name('order-sheet-waybills.print');

Route::get('/items', [ItemController::class, 'index']);
Route::get('/items/{item}', [ItemController::class, 'show']);
Route::get('/items/sku/{sku}', [ItemController::class, 'showBySku']);
Route::get('/items/barcode/{barcode}', [ItemController::class, 'showByBarcode']);
Route::post('/items/{item}/balance', [ItemController::class, 'balance']);
Route::post('/items/{item}/balance-by-barcode', [ItemController::class, 'balanceByBarcode']);

Route::get('/order-shipments', [OrderShipmentController::class, 'index']);
Route::get('/order-shipments/{order_shipment}', [OrderShipmentController::class, 'show']);
Route::get('/order-shipments/pause', [OrderShipmentController::class, 'pause']);

Route::get('/box/{code}', [BoxController::class, 'showByCode']);
