<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class Good extends Model
{
    use Actionable, HasFactory;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'list_image' => 'string',
            'name' => 'string',
            'option' => 'string',
            'supplier_monitoring_price' => 'integer',
            'supplier_monitoring_status' => 'string',
            'goods_price' => 'integer',
            'memo' => 'string',
            'zero_margin_price' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Good $good) {
            $good->author_id = $good->author_id ?? Auth::user()->id;
        });

        static::saved(function (Good $good) {
            if (is_null($good->goods_code)) {
                $good->goods_code = $good->id;
                $good->save();
            }
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Get the good's promotion code.
     *
     * @see https://laravel.com/docs/11.x/eloquent-relationships#one-to-one-polymorphic-model-structure
     */
    public function promotionCode(): MorphOne
    {
        return $this->morphOne(PromotionCode::class, 'codable');
    }

    /**
     * Get the option good option's master code.
     *
     * @see https://laravel.com/docs/11.x/eloquent-relationships#one-to-one-polymorphic-model-structure
     */
    public function optionGoodOption(): MorphOne
    {
        return $this->morphOne(OptionGoodOption::class, 'optionable');
    }
}
