<?php

namespace App\Imports;

use App\Models\Good;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GoodsImport implements SkipsEmptyRows, ToModel, WithHeadingRow
{
    /**
     * @return Good|null
     */
    public function model(array $row)
    {
        foreach ($row as $key => $value) {
            if (is_null($value)) {
                unset($row[$key]);
            }
        }

        return new Good($row);
    }

    public function headingRow(): int
    {
        return 3;
    }
}
