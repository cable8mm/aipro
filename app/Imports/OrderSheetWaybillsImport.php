<?php

namespace App\Imports;

use App\ArrayObjects\OrderShipment as ArrayObjectsOrderShipment;
use App\Models\OrderSheetWaybill;
use App\Models\OrderShipment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class OrderSheetWaybillsImport implements SkipsEmptyRows, ToCollection, WithStartRow
{
    private OrderSheetWaybill $orderSheetWaybill;

    private int $numberOfLines = 0;

    public function __construct(OrderSheetWaybill $orderSheetWaybill)
    {
        $this->orderSheetWaybill = $orderSheetWaybill;
    }

    /**
     * @return OrderSheetWaybill|null
     */
    public function collection(Collection $rows)
    {
        $waybillFilePage = 1;

        /**
         * @var \Illuminate\Support\Collection $row
         */
        foreach ($rows as $row) {
            $optionShipments = ArrayObjectsOrderShipment::of(
                $row,
                id: $this->orderSheetWaybill->id,
                waybillFilePage: $waybillFilePage++
            )->toArray();

            /**
             * @var array<T> $optionShipments Collection of `OrderShipment` model values of the rows
             * @var array<string, TValue> $optionShipment `OrderShipment` model values of the row
             */
            foreach ($optionShipments as $optionShipment) {
                OrderShipment::create(
                    $optionShipment
                );
            }

            $this->numberOfLines++;
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    public function getNumberOfLines(): int
    {
        return $this->numberOfLines;
    }
}
