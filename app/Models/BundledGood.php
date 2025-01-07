<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundledGood extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'playauto_master_code' => 'string',
            'name' => 'string',
            'set_code' => 'string',
            'goods_price' => 'integer'
        ];
    }
}
