<?php

namespace App\Models;

use Cable8mm\GoodCodeParser\GoodCode;
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

    protected $with = ['author'];

    protected function casts(): array
    {
        return [
            'master_code' => 'string',
            'name' => 'string',
            'goods_price' => 'integer',
            'last_cost_price' => 'integer',
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
            $setGood->updateMasterCode();
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

    public function goods(): BelongsToMany
    {
        return $this->belongsToMany(Good::class)
            ->withPivot('count')
            ->using(GoodSetGood::class);
    }

    /**
     * Generate master code for the set good.
     *
     * @return bool The method returns the result of success or fail
     */
    public function updateMasterCode(): bool
    {
        $setCodes = $this->goods()->pluck('count', 'master_code')->toArray();
        $this->master_code = empty($setCodes) ? null : GoodCode::makeSetCode($setCodes);

        return $this->saveQuietly();
    }
}
