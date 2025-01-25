<?php

namespace App\Nova\Metrics;

use App\Models\Box;
use App\Models\Setting;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Progress;

class BoxSumInventory extends Progress
{
    /**
     * Calculate the value of the metric.
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->sum($request, Box::class, function ($query) {
            return $query;
        }, 'inventory', target: Setting::get('GOAL_FOR_INVENTORY_SUM_OF_BOXES'))->suffix('개')
            ->format([
                'thousandSeparated' => true,
            ]);
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
        return 'box-sum-inventory';
    }

    public function name()
    {
        return __('Box Sum Inventory');
    }
}
