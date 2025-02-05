<?php

namespace App\Exceptions;

use App\ArrayObjects\MismatchedOrderShipment as ArrayObjectsMismatchedOrderShipment;
use App\ArrayObjects\OrderShipment;
use App\Models\MismatchedOrderShipment;
use InvalidArgumentException;

class OptionGoodInvalidArgumentException extends InvalidArgumentException
{
    public function __construct(string $message, private OrderShipment $orderShipment)
    {
        return parent::__construct($message);
    }

    public function save(): void
    {
        MismatchedOrderShipment::create(
            ArrayObjectsMismatchedOrderShipment::of($this->orderShipment)->toArray()
        );
    }
}
