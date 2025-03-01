<?php

namespace App\Http\Controllers\Api\Web;

use App\Enums\OrderShipmentStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderShipmentResource;
use App\Models\OrderShipment;
use Illuminate\Http\Request;

class OrderShipmentController extends Controller
{
    /**
     * /api/web/order-shipments
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
            'order_no' => 'nullable|string|required_without:waybill_no',
            /**
             * Waybill number
             *
             * @example 912432837263
             */
            'waybill_no' => 'nullable|string|required_without:order_no',
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
     * /api/web/order-shipments/{id}
     *
     * Get a order shipment resource
     */
    public function show(OrderShipment $order_shipment)
    {
        return new OrderShipmentResource($order_shipment);
    }

    /**
     * /api/web/order-shipments/pause
     *
     * While the processing is on going, it is able to pause a order from processing
     */
    public function pause()
    {
        $count = OrderShipment::where('status', OrderShipmentStatus::임시저장->name)->distinct()->count('orderNo');

        return response()->json([
            'count' => (int) $count,
        ]);
    }
}
