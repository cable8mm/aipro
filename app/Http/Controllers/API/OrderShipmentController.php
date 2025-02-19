<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderShipmentResource;
use App\Models\OrderShipment;
use Illuminate\Http\Request;

class OrderShipmentController extends Controller
{
    /**
     * /order-shipments
     *
     * Get order shipments with paging
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            /**
             * Order number
             *
             * @example 407518300914
             */
            'order_no' => 'nullable|string',
            /**
             * Waybill number
             *
             * @example 912432837263
             */
            'waybill_no' => 'nullable|string',
        ]);

        $orderShipment = OrderShipment::on();

        if ($request->has('orderNo')) {
            $orderShipment->where('orderNo', $validated['order_no']);
        }

        if ($request->has('waybillNo')) {
            $orderShipment->where('waybillNo', $validated['waybill_no']);
        }

        $orderShipments = $orderShipment->latest()
            ->paginate(
                perPage: $request->integer('per_page', 12),
                page: $request->integer('page', 1)
            );

        return OrderShipmentResource::collection($orderShipments);
    }

    /**
     * /order-shipments/{id}
     *
     * Get a order shipment resource
     */
    public function show(OrderShipment $order_shipment)
    {
        return new OrderShipmentResource($order_shipment);
    }

    /**
     * /order-shipments/pause
     *
     * While the processing is on going, it is able to pause a order from processing
     */
    public function pause()
    {
        $count = OrderShipment::where('status', '임시저장')->distinct()->count('orderNo');

        return response()->json([
            'count' => $count,
        ]);
    }
}
