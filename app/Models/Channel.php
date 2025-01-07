<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'last_process_maestro_id' => 'integer',
            'name' => 'string',
            'playauto_site' => 'string',
            'siteid' => 'string',
            'fee_rate' => 'decimal:2',
            'total_good_count' => 'integer',
            'total_sale_good_count' => 'integer',
            'total_sold_out_good_count' => 'integer',
            'total_no_sale_good_count' => 'integer',
            'filepath' => 'string',
            'last_processed' => 'datetime',
            'is_active' => 'boolean',
            'status' => 'string'
        ];
    }
}
