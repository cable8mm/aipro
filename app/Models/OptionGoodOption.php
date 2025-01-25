<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class OptionGoodOption extends Model
{
    use Actionable, HasFactory;

    protected $with = ['author', 'optionGood'];

    protected function casts(): array
    {
        return [
            'master_code' => 'string',
            'name' => 'string',
            'goods_price' => 'integer',
            'last_cost_price' => 'integer',
            'zero_margin_price' => 'integer',
            'suggested_selling_price_of_gms' => 'integer',
            'order' => 'integer',
            'goods_bar' => 'string',
            'is_my_shop_sale' => 'boolean',
            'is_other_shop_sale' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (OptionGoodOption $optionGoodOption) {
            $optionGoodOption->author_id = $optionGoodOption->author_id ?? Auth::user()->id;
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function optionGood(): BelongsTo
    {
        return $this->belongsTo(OptionGood::class);
    }
}
