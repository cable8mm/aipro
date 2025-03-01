<?php

use App\Http\Controllers\Api\Web\BoxController;
use App\Http\Controllers\Api\Web\GenerateBarcodeController;
use App\Http\Controllers\Api\Web\ItemController;
use App\Http\Controllers\Api\Web\ItemManualWarehousingController;
use App\Http\Controllers\Api\Web\OrderController;
use App\Http\Controllers\Api\Web\OrderSheetWaybillController;
use App\Http\Controllers\Api\Web\OrderShipmentController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/web')->group(function () {

    Route::get('/generate-barcode/{barcode}', GenerateBarcodeController::class)->name('generate-barcode');

    Route::put('/orders/{order}', [OrderController::class, 'update']);
    Route::get('/orders/{order}/print', [OrderController::class, 'print'])->name('orders.print')->middleware('auth:sanctum');
    Route::get('/orders/{order}/waybill', [OrderController::class, 'waybill']);
    Route::get('/orders/{order}/clear-order', [OrderController::class, 'clearOrder']);
    Route::get('/orders/{waybill_numbers}/order-shipments', [OrderController::class, 'orderShipments']);

    Route::get('/order-sheet-waybills/{order_sheet_waybill}/print', [OrderSheetWaybillController::class, 'print'])->name('order-sheet-waybills.print');

    Route::get('/items', [ItemController::class, 'index']);
    Route::get('/items/{item}', [ItemController::class, 'show']);
    Route::get('/items/sku/{sku}', [ItemController::class, 'showFromSku']);
    Route::get('/items/barcode/{barcode}', [ItemController::class, 'showFromBarcode']);

    Route::get('/order-shipments', [OrderShipmentController::class, 'index']);
    Route::get('/order-shipments/pause', [OrderShipmentController::class, 'pause']);
    Route::get('/order-shipments/{order_shipment}', [OrderShipmentController::class, 'show'])->whereNumber('order_shipment');

    Route::get('/box/{code}', [BoxController::class, 'showFromSku']);

    Route::post('/item-manual-warehousings', [ItemManualWarehousingController::class, 'store']);
    Route::post('/item-manual-warehousings/barcode/{barcode}', [ItemManualWarehousingController::class, 'storeFromBarcode']);
});
