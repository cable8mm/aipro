<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoxInventoryHistory extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'ct_box_id' => 'integer',
            'type' => 'string',
            'quantity' => 'integer',
            'model' => 'string',
            'attribute' => 'string',
            'is_success' => 'boolean',
        ];
    }
}
