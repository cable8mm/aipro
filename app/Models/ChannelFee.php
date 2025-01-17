<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class ChannelFee extends Model
{
    use Actionable, HasFactory;

    protected function casts(): array
    {
        return [
            'channel' => 'string',
            'fee_rate' => 'decimal:2',
        ];
    }
}
