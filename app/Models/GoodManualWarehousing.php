<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Nova\Actions\Actionable;

class GoodManualWarehousing extends Model
{
    use Actionable, HasFactory;

    protected $with = ['good', 'user'];

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
