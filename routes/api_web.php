<?php

use App\Http\Controllers\Api\Web\BarcodeCommandController;
use App\Http\Controllers\Api\Web\BoxController;
use App\Http\Controllers\Api\Web\GenerateBarcodeController;
use App\Http\Controllers\Api\Web\ItemController;
use App\Http\Controllers\Api\Web\ItemManualWarehousingController;
use App\Http\Controllers\Api\Web\OrderController;
use App\Http\Controllers\Api\Web\OrderSheetWaybillController;
use App\Http\Controllers\Api\Web\OrderShipmentController;
use App\Http\Controllers\Api\Web\RetailPurchaseController;
use Illuminate\Support\Facades\Route;

Route::get('/generate-barcode/{barcode}', GenerateBarcodeController::class)
    ->name('generate-barcode');

Route::middleware(['auth:sanctum'])->prefix('api/web')->group(function () {

    Route::put('/orders/{order}', [OrderController::class, 'update'])
        ->name('orders.update');
    Route::get('/orders/{order}/print', [OrderController::class, 'print'])
        ->name('orders.print');
    Route::get('/orders/{order}/waybill', [OrderController::class, 'waybill'])
        ->name('orders.waybill');
    Route::get('/orders/{order}/clear-order', [OrderController::class, 'clearOrder'])
        ->name('orders.clear-order');
    Route::get('/orders/{waybill_numbers}/order-shipments', [OrderController::class, 'orderShipments'])
        ->name('orders.order-shipments');

    Route::get('/order-sheet-waybills/{orderSheetWaybill}/print', [OrderSheetWaybillController::class, 'print'])
        ->name('order-sheet-waybills.print');

    Route::get('/retail-purchases/{retailPurchase}/print', [RetailPurchaseController::class, 'print'])
        ->name('retail-purchases.print');

    Route::get('/items', [ItemController::class, 'index'])
        ->name('items');
    Route::get('/items/{item}', [ItemController::class, 'show'])
        ->name('items.show');
    Route::get('/items/sku/{sku}', [ItemController::class, 'showFromSku'])
        ->name('items.show-from-sku');
    Route::get('/items/barcode/{barcode}', [ItemController::class, 'showFromBarcode'])
        ->name('items.show-from-barcode');

    Route::get('/order-shipments', [OrderShipmentController::class, 'index'])
        ->name('order-shipments');
    Route::get('/order-shipments/pause', [OrderShipmentController::class, 'pause'])
        ->name('order-shipments.pause');
    Route::get('/order-shipments/{order_shipment}', [OrderShipmentController::class, 'show'])
        ->whereNumber('order_shipment')
        ->name('order-shipments.show');

    Route::get('/box/{sku}', [BoxController::class, 'showFromSku'])
        ->name('box.show-from-sku');

    Route::post('/item-manual-warehousings', [ItemManualWarehousingController::class, 'store'])
        ->name('item-manual-warehousings.store');
    Route::post('/item-manual-warehousings/barcode/{barcode}', [ItemManualWarehousingController::class, 'storeFromBarcode'])
        ->name('item-manual-warehousings.store-from-barcode');

    Route::get('/barcode-command/print', [BarcodeCommandController::class, 'print'])
        ->name('barcode-command.print');

});
