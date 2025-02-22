<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;

class BoxInventoryHistory extends Model
{
    protected $with = ['box'];

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'type' => 'string',
            'quantity' => 'integer',
            'model' => 'string',
            'attribute' => 'string',
            'is_success' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (BoxInventoryHistory $boxInventoryHistory) {
            $boxInventoryHistory->author_id = $boxInventoryHistory->author_id ?? Auth::user()->id ?? null;
        });
    }

    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the parent inventoryHistoryable model (box_purchase_orders or ...).
     */
    public function historyable(): MorphTo
    {
        return $this->morphTo();
    }
}
