<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class SetGood extends Model
{
    use Actionable, HasFactory;

    protected $with = ['author'];

    protected function casts(): array
    {
        return [
            'master_code' => 'string',
            'godo_code' => 'string',
            'featured_good_list' => 'string',
            'name' => 'string',
            'goods_price' => 'integer',
            'last_cost_price' => 'integer',
            'zero_margin_price' => 'integer',
            'suggested_selling_price_of_gms' => 'integer',
            'is_gift' => 'boolean',
            'is_shutdown' => 'boolean',
            'goods_bar' => 'string',
            'is_my_shop_sale' => 'boolean',
            'is_other_shop_sale' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (SetGood $setGood) {
            $setGood->author_id = $setGood->author_id ?? Auth::user()->id;
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the set good's promotion code.
     *
     * @see https://laravel.com/docs/11.x/eloquent-relationships#one-to-one-polymorphic-model-structure
     */
    public function promotionCode(): MorphOne
    {
        return $this->morphOne(PromotionCode::class, 'promotion_codable');
    }
}
