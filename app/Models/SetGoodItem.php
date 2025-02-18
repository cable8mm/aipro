<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SetGoodItem extends Pivot
{
    protected $touches = ['setGood'];

    protected static function booted(): void
    {
        static::saved(function (SetGoodItem $setGoodItem) {
            $setGoodItem->setGood->updateSpecificFields();
        });
    }

    public function setGood(): BelongsTo
    {
        return $this->belongsTo(SetGood::class, 'set_good_id');
    }
}
