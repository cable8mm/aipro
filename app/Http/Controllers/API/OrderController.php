<?php

namespace App\Http\Controllers\API;

use App\Enums\OrderShipmentStatus;
use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\Order;
use App\Models\OrderShipment;
use Cable8mm\Waybill\Enums\ParcelService;
use Cable8mm\Waybill\Slicer;
use Cable8mm\Waybill\Waybill;
use Illuminate\Http\Request;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;

class OrderController extends Controller
{
    /**
     * /orders/{order}/print
     *
     * Print the order
     */
    public function print(Order $order)
    {
        $pdf = LaravelMpdf::loadView('pdf.order_invoice', [
            'order' => $order,
        ]);

        return $pdf->stream('document.pdf');
    }

    /**
     * /orders/{order}/waybill
     *
     * Download a waybill from order number
     */
    public function waybill(Order $order): mixed
    {
        $invoiceFilePath = $order->orderSheetInvoice->invoice_file;

        return Slicer::of(ParcelService::Cj, $order->invoiceFilePage)
            ->source($invoiceFilePath)
            ->download('waybill_'.$order->id.'.pdf');
    }

    /**
     * /orders/{order}
     *
     * Update order shipment by monitoring
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'mode' => 'required|not_in:0',
            'orderNo' => 'required|not_in:0',
            'items.*' => 'required|array|not_in:0',
            'items.*.id' => 'required|integer|not_in:0',
            'items.*.goodsCd' => 'required|string|not_in:0',
            'items.*.confirmAmount' => 'required|integer|not_in:0',
            'boxes.*' => 'required|array:size,quantity|not_in:0',
            'boxes.*.size' => 'required|integer|not_in:0',
            'boxes.*.quantity' => 'required_with:boxes.size|integer|not_in:0',
            'invoices' => 'required|array|not_in:0',
            'validator' => 'required|integer|not_in:0',
        ]);

        $invoiceNos = implode(',', $validated['invoices']);

        if ($validated['mode'] == 'complete') {
            $status = OrderShipmentStatus::검수완료->value;
        } elseif ($validated['mode'] == 'partial') {
            $status = OrderShipmentStatus::부분검수완료->value;
        } else {
            $status = OrderShipmentStatus::임시저장->value;
        }

        $order->orderShipments()->update([
            'validator' => $validated['validator'],
            'invoiceNo' => $invoiceNos,
            'status' => $status,
        ]);

        foreach ($validated['boxes'] as $box) {
            Box::find($box['size'])->plusminus($box['size'], $box['quantity'] * (-1), Order::class, $order->id);
        }

        foreach ($validated['items'] as $item) {
            $orderShipment = OrderShipment::find($item['id']);
            $orderShipment->update([
                'confirmAmount' => $item['confirmAmount'],
                'completed_at' => now(),
            ]);

            if ($validated['mode'] == 'complete' || $validated['mode'] == 'partial') {
                $confirmAmount = $item['confirmAmount'] - $orderShipment->confirmAmount;

                if ($confirmAmount > 0) {
                    $orderShipment->good()->plusminus(
                        $confirmAmount * (-1),
                        OrderShipment::class,
                        $orderShipment->id
                    );
                }
            }
        }

        return response()->json([], 200);
    }

    /**
     * /orders/{order}/clear-order
     *
     * Clear current orders from order number
     */
    public function clearOrder(Order $order)
    {
        $order->updateOrFail([
            'OrderShipment.status' => "'상품준비중'",
            'OrderShipment.confirmAmount' => 0,
            'OrderShipment.boxes' => null,
            'OrderShipment.invoiceCompany' => null,
            'OrderShipment.invoiceNo' => null,
        ]);

        return response()->json([
            'result' => 'success',
        ]);
    }
}
