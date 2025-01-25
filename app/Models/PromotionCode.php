<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Laravel\Nova\Actions\Actionable;

class PromotionCode extends Model
{
    use Actionable, HasFactory;

    protected $with = ['author'];

    protected function casts(): array
    {
        return [
            'master_code' => 'string',
            'memo' => 'string',
            'started_at' => 'datetime',
            'finished_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (PromotionCode $promotionCode) {
            $promotionCode->ordinal_number = $promotionCode->getOrdinalNumber();
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function promotionCodable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the original master code as virtual field.
     *
     * @example $model->real_master_code Original master code to be copied as virtual field.
     */
    protected function masterCode(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $this->promotionCodable->master_code.'+'.$this->ordinal_number,
        );
    }

    public function getOrdinalNumber(): int
    {
        return (self::where('promotion_codable_type', $this->promotion_codable_type)
            ->where('promotion_codable_id', $this->promotion_codable_id)
            ->orderBy('ordinal_number', 'desc')
            ->limit(1)
            ->value('ordinal_number') ?? 0) + 1;
    }
}
