<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class B2bGood extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'cms_maestro_id' => 'integer',
            'goods_no' => 'string',
            'playauto_master_code' => 'string'
        ];
    }
}
