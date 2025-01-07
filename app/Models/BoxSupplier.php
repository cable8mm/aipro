<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoxSupplier extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'ordered_email' => 'string',
            'contact_name' => 'string',
            'contact_tel' => 'string',
            'contact_cel' => 'string',
            'order_method' => 'integer',
            'balance_criteria' => 'string',
            'min_order_price' => 'integer',
            'is_parceled' => 'boolean'
        ];
    }
}
