<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class BoxSupplier extends Model
{
    use Actionable, HasFactory;

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'ordered_email' => 'string',
            'contact_name' => 'string',
            'contact_tel' => 'string',
            'contact_cel' => 'string',
            'min_order_price' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (BoxSupplier $boxSupplier) {
            $boxSupplier->author_id = $boxSupplier->author_id ?? Auth::user()->id;
        });
    }

    public function placingOrderBoxes(): HasMany
    {
        return $this->hasMany(PlacingOrderBox::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
