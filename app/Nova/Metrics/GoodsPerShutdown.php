<?php

namespace App\Nova\Metrics;

use App\Models\Item;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class GoodsPerShutdown extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, Item::class, 'is_shutdown')
            ->label(fn ($value) => match ($value) {
                1 => __('Off Sale'),
                null => __('On Sale'),
            });
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
        return 'goods-per-shutdown';
    }

    public function name()
    {
        return __('Goods Per Shutdown');
    }
}
