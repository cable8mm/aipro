<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionCode extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'playauto_master_code' => 'string',
            'godo_code' => 'string',
            'memo' => 'string',
            'started' => 'datetime',
            'finished' => 'datetime',
            'cms_maestro_id' => 'integer',
        ];
    }
}
