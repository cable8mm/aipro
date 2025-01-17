<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class Box extends Model
{
    use Actionable, HasFactory;

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'code' => 'string',
            'size' => 'integer',
            'delivery_price' => 'integer',
            'box_price' => 'integer',
            'inventory' => 'integer',
            'memo' => 'string',
        ];
    }
}
