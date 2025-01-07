<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceCoefficient extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'start_price' => 'integer',
            'end_price' => 'integer',
            'coefficient' => 'decimal:3'
        ];
    }
}
