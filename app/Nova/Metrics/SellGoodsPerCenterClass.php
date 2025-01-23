<?php

namespace App\Nova\Metrics;

use App\Enums\CenterClass;
use App\Models\Good;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class SellGoodsPerCenterClass extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, Good::notShutdown(), 'center_class')
            ->label(fn ($value) => CenterClass::{$value}->value());
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
        return 'sell-goods-per-center-class';
    }

    public function name()
    {
        return __('Sell Goods Per Center Class');
    }
}
