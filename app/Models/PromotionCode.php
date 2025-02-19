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

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'sku' => 'string',
            'memo' => 'string',
            'started_at' => 'datetime',
            'finished_at' => 'datetime',
        ];
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
     * @example $model->real_sku Original master code to be copied as virtual field.
     */
    protected function goodsCode(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $this->promotionCodable->goods_code.'+'.$this->id,
        );
    }
}
