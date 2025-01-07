<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoxManualWarehousing extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'ct_box_id' => 'integer',
            'cms_maestro_id' => 'integer',
            'type' => 'string',
            'manual_add_inventory_count' => 'integer',
        ];
    }
}
