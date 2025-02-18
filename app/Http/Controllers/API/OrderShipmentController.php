<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderShipmentResource;
use App\Models\OrderShipment;

class OrderShipmentController extends Controller
{
    /**
     * /order-shipments/order/{id}
     *
     * You can use this method by passing the `OrderShipment.id` of the order or the name of the `OrderShipment.invoiceNo`
     *
     * @param  int  $id  order_shipment.id 값 || order_shipment.invoiceNo 값
     * @return JSON
     */
    public function order($id)
    {
        $order = [];

        // 주문번호 바코드에서 주문번호를 뽑는 로직 000+OrderShipmentId+0
        // e.g. 0005668640
        $id = preg_replace('/^0+([0-9]+)[0-9]$/', '\\1', $id);

        if (OrderShipment::where('id', $id)->exists()) {
            $order = OrderShipment::find($id);
        } elseif (OrderShipment::where('invoiceNo', $id)->exists()) {
            $order = OrderShipment::where('invoiceNo', $id)->first();
        }

        if (empty($order)) {
            throw new \InvalidArgumentException;
        }

        $orders = OrderShipment::where('orderNo', $order->orderNo)->get();

        return OrderShipmentResource::collection($orders);
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
