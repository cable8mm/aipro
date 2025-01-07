<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodInventorySnapshot extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'cms_maestro_id' => 'integer',
            'ct_good_id' => 'integer',
            'playauto_master_code' => 'string',
            'inventory' => 'integer',
            'type' => 'string'
        ];
    }
}
