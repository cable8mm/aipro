<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodManualWarehousing extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'ct_good_id' => 'integer',
            'cms_maestro_id' => 'integer',
            'manual_add_inventory_count' => 'integer',
            'type' => 'string'
        ];
    }
}
