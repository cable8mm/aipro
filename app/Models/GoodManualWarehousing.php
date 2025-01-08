<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GoodManualWarehousing extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'manual_add_inventory_count' => 'integer',
            'type' => 'string',
        ];
    }

    public function good(): BelongsTo
    {
        return $this->belongsTo(Good::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
