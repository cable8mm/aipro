<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Nova\Actions\Actionable;

class Channel extends Model
{
    use Actionable, HasFactory;

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'name' => 'string',
            'playauto_site' => 'string',
            'siteid' => 'string',
            'fee_rate' => 'decimal:2',
            'total_good_count' => 'integer',
            'total_sale_good_count' => 'integer',
            'total_sold_out_good_count' => 'integer',
            'total_no_sale_good_count' => 'integer',
            'filepath' => 'string',
            'last_processed_at' => 'datetime',
            'is_active' => 'boolean',
            'status' => 'string',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
