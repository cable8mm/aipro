<?php

namespace App\Models;

use Cable8mm\GoodCode\GoodCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class SetGood extends Model
{
    use Actionable, HasFactory;

    protected function casts(): array
    {
        return [
            'goods_code' => 'string',
            'name' => 'string',
            'goods_price' => 'integer',
            'zero_margin_price' => 'integer',
            'suggested_selling_price_of_gms' => 'integer',
            'is_shutdown' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (SetGood $setGood) {
            $setGood->author_id = $setGood->author_id ?? Auth::user()->id;
        });

        static::saved(function (SetGood $setGood) {
            $setGood->updateSpecificFields();
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
        return $this->morphOne(PromotionCode::class, 'codable');
    }

    /**
     * Get the option good option's master code.
     *
     * @see https://laravel.com/docs/11.x/eloquent-relationships#one-to-one-polymorphic-model-structure
     */
    public function optionGoodOption(): MorphOne
    {
        return $this->morphOne(OptionGoodOption::class, 'optionGoodOptionable');
    }

    public function goods(): BelongsToMany
    {
        return $this->belongsToMany(Good::class, 'set_good_good')
            ->withPivot('quantity')
            ->using(SetGoodGood::class);
    }

    public static function findComCode(string $code): static
    {
        return static::find(GoodCode::getId($code));
    }

    /**
     * Generate master code for the set good.
     *
     * @return bool The method returns the result of success or fail
     */
    public function updateSpecificFields(): bool
    {
        $goodsOfSetGoods = $this->goods();

        $setCodes = $goodsOfSetGoods->pluck('quantity', 'goods_code')->toArray();
        $this->goods_code = empty($setCodes) ? null : GoodCode::setCodeOf($setCodes)->code();
        $this->good_count = count($setCodes);

        $this->goods_price = $goodsOfSetGoods->sum('goods_price');
        $this->zero_margin_price = $goodsOfSetGoods->sum('zero_margin_price');

        return $this->saveQuietly();
    }
}
