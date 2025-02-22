<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class BoxManualWarehousing extends Model
{
    use Actionable, HasFactory;

    protected $with = ['box', 'author'];

    protected function casts(): array
    {
        return [
            'type' => 'string',
            'manual_add_inventory_count' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (BoxManualWarehousing $boxManualWarehousing) {
            $boxManualWarehousing->author_id = $boxManualWarehousing->author_id ?? Auth::user()->id;
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
}
