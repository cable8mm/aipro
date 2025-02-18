<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class ItemManualWarehousing extends Model
{
    use Actionable, HasFactory;

    protected $with = ['item', 'author'];

    protected function casts(): array
    {
        return [
            'manual_add_inventory_count' => 'integer',
            'type' => 'string',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (ItemManualWarehousing $goodManualWarehousing) {
            $goodManualWarehousing->author_id = $goodManualWarehousing->author_id ?? Auth::user()->id;
        });
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
