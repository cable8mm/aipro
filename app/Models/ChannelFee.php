<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelFee extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'channel' => 'string',
            'fee_rate' => 'decimal:2',
        ];
    }
}
