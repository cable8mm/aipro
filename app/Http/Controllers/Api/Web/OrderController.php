<?php

namespace App\Http\Controllers\Api\Web;

use App\Enums\OrderShipmentStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderShipmentResource;
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
     * /api/web/orders/{id}/print
     *
     * Print the order
     */
    public function print(Order $order)
    {
        $pdf = LaravelMpdf::loadView('pdf.order_waybill', [
            'order' => $order,
        ]);

        $order->increment('printed_count');

        return $pdf->stream('document.pdf');
    }

    /**
     * /api/web/orders/{id}/waybill
     *
     * Download a waybill from order number
     */
    public function waybill(Order $order): mixed
    {
        $waybillFilePath = $order->orderSheetWaybill->waybill_file;

        return Slicer::of(ParcelService::Cj, $order->waybillFilePage ?? 1)
            ->source($waybillFilePath)
            ->download('waybill_'.$order->id.'.pdf');
    }

    /**
     * /api/web/orders/{id}
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
            'waybills' => 'required|array|not_in:0',
            'validator' => 'required|integer|not_in:0',
        ]);

        $waybillNos = implode(',', $validated['waybills']);

        if ($validated['mode'] == 'complete') {
            $status = OrderShipmentStatus::검수완료;
        } elseif ($validated['mode'] == 'partial') {
            $status = OrderShipmentStatus::부분검수완료;
        } else {
            $status = OrderShipmentStatus::임시저장;
        }

        $order->orderShipments()->update([
            'validator' => $validated['validator'],
            'waybillNo' => $waybillNos,
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
                    $orderShipment->item()->plusminus(
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
     * /api/web/orders/{id}/clear-order
     *
     * Clear current orders from order number
     */
    public function clearOrder(Order $order)
    {
        $order->updateOrFail([
            'OrderShipment.status' => "'상품준비중'",
            'OrderShipment.confirmAmount' => 0,
            'OrderShipment.boxes' => null,
            'OrderShipment.waybillCompany' => null,
            'OrderShipment.waybillNo' => null,
        ]);

        return response()->json([
            'result' => 'success',
        ], 200);
    }

    /**
     * /api/web/order/{waybill_numbers}/order-shipments
     *
     * Get order-shipments by waybill number
     *
     * @param  string  $waybill_numbers  The waybill number
     */
    public function orderShipments(string $waybill_numbers)
    {
        $order = Order::where('waybill_numbers', $waybill_numbers)->firstOrFail();

        return OrderShipmentResource::collection($order->orderShipments);
    }
}
