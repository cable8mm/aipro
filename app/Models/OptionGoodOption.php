<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class OptionGoodOption extends Model implements Sortable
{
    use Actionable, HasFactory, SortableTrait;

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
        'nova_order_by' => 'DESC',
        'sort_on_has_many' => true,
    ];

    protected function casts(): array
    {
        return [
            'goods_code' => 'string',
            'name' => 'string',
            'goods_price' => 'integer',
            'last_cost_price' => 'integer',
            'zero_margin_price' => 'integer',
            'suggested_selling_price_of_gms' => 'integer',
            'order' => 'integer',
            'goods_bar' => 'string',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (OptionGoodOption $optionGoodOption) {
            $optionGoodOption->author_id = $optionGoodOption->author_id ?? Auth::user()->id;
        });

        static::saving(function (OptionGoodOption $optionGoodOption) {
            if ($optionGoodOption->optionable_type::where('id', $optionGoodOption->optionable_id)->doesntExist()) {
                throw new \InvalidArgumentException(__('OptionGood Option cannot be connected to Good or SetGood.'));
            }
        });

        static::saved(function (OptionGoodOption $optionGoodOption) {
            $optionGoodOption->optionGood->updateSpecificFields();
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

    public function optionable(): MorphTo
    {
        return $this->morphTo();
    }

    public function goodsCode(): string
    {
        return $this->optionable->goods_code;
    }
}
