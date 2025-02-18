<?php

namespace App\Nova\Metrics;

use App\Models\Item;
use App\Models\Setting;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Progress;

class GoodSumCostPrice extends Progress
{
    /**
     * Calculate the value of the metric.
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->sum($request, Item::class, function ($query) {
            return $query;
        }, 'cost_price', target: Setting::get('GOAL_FOR_COST_PRICE_SUM_OF_GOODS'))->suffix(__('Won'));
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return \DateTimeInterface|\DateInterval|float|int
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
        return 'good-sum-price';
    }

    public function name()
    {
        return __('Good Sum Cost Price');
    }
}
