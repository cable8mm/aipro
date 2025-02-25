<?php

namespace App\Nova\Metrics;

use App\Enums\SafeClass;
use App\Models\Item;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class SellGoodsPerSafeClass extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, Item::onSale(), 'safe_class')
            ->label(fn ($value) => SafeClass::{$value}->value());
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return \DateTimeInterface|\DateInterval|float|int|null
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'sell-goods-per-safe-class';
    }

    public function name()
    {
        return __('Sell Goods Per Safe Class');
    }
}
