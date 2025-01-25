<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class BoxInventoryHistory extends Model
{
    use HasFactory;

    protected $with = ['box'];

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
            $boxInventoryHistory->author_id = $boxInventoryHistory->author_id ?? Auth::user()->id;
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
