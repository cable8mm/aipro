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

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'sku' => 'string',
            'memo' => 'string',
            'started_at' => 'datetime',
            'finished_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function codable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the original master code as virtual field.
     *
     * @example $model->real_sku Original master code to be copied as virtual field.
     */
    protected function goodsCode(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $this->codable->goods_code.'+'.$this->id,
        );
    }
}
