<?php

namespace App\Imports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemsImport implements SkipsEmptyRows, ToModel, WithHeadingRow
{
    /**
     * @return Item|null
     */
    public function model(array $row)
    {
        foreach ($row as $key => $value) {
            if (is_null($value)) {
                unset($row[$key]);
            }
        }

        return new Item($row);
    }

    public function headingRow(): int
    {
        return 3;
    }
}
