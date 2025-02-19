<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
            'playauto_category_id' => 'integer',
            'name' => 'string',
            'option' => 'string',
            'supplier_monitoring_price' => 'integer',
            'supplier_monitoring_status' => 'string',
            'supplier_monitoring_interruption' => 'boolean',
            'goods_price' => 'integer',
            'memo' => 'string',
            'naver_category' => 'integer',
            'naver_productid' => 'integer',
            'naver_lowest_price_wrong' => 'boolean',
            'naver_lowest_price' => 'integer',
            'internet_lowest_price' => 'integer',
            'zero_margin_price' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Good $good) {
            $good->author_id = $good->author_id ?? Auth::user()->id;
        });

        static::saved(function (Good $good) {
            if (is_null($good->sku)) {
                $good->sku = $good->id;
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
}
