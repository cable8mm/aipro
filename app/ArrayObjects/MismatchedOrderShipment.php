<?php

namespace App\ArrayObjects;

use App\Enums\MismatchedOrderShipmentStatus;
use Illuminate\Contracts\Support\Arrayable;

class MismatchedOrderShipment implements Arrayable
{
    public OrderShipment $orderShipment;

    private array $container;

    public function __construct(
        OrderShipment $orderShipment
    ) {
        $this->container['order_sheet_waybill_id'] = $orderShipment->data->get('order_sheet_waybill_id');
        $this->container['order_no'] = $orderShipment->data->get('orderNo');
        $this->container['site'] = $orderShipment->data->get('site');
        $this->container['goods_cd'] = $orderShipment->data->get('goodsCd');
        $this->container['goods_nm'] = $orderShipment->data->get('goodsNm');
        $this->container['option'] = $orderShipment->data->get('option');
        $this->container['json'] = $orderShipment->data;
        $this->container['status'] = MismatchedOrderShipmentStatus::READY;
    }

    public function toArray(): array
    {
        return $this->container;
    }

    public static function of(OrderShipment $orderShipment): static
    {
        return new static($orderShipment);
    }
}
