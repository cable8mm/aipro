<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryHistory extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'cms_maestro_id' => 'integer',
            'ct_good_id' => 'integer',
            'type' => 'string',
            'quantity' => 'integer',
            'price' => 'integer',
            'after_quantity' => 'integer',
            'model' => 'string',
            'attribute' => 'integer',
            'cancel_id' => 'integer',
            'is_success' => 'boolean',
        ];
    }
}
