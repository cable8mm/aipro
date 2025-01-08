<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BoxManualWarehousing extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'type' => 'string',
            'manual_add_inventory_count' => 'integer',
        ];
    }

    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
