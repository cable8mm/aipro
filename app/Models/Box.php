<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class Box extends Model
{
    use Actionable, HasFactory;

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'code' => 'string',
            'size' => 'integer',
            'delivery_price' => 'integer',
            'box_price' => 'integer',
            'inventory' => 'integer',
            'memo' => 'string',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Box $box) {
            $box->author_id = $box->author_id ?? Auth::user()->id;
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function placingOrderBoxes(): HasMany
    {
        return $this->hasMany(PlacingOrderBox::class);
    }
}
