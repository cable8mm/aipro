<?php

namespace App\Nova\Filters;

use App\Enums\PlacingOrder;
use Laravel\Nova\Filters\BooleanFilter;
use Laravel\Nova\Http\Requests\NovaRequest;

class PlacingOrderFinished extends BooleanFilter
{
    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(NovaRequest $request, $query, $value)
    {
        return $query->where(function ($query) use ($value) {
            if ($value['except_warehoused_confirmed_deleted'] == 1) {
                $query->whereIn('status', PlacingOrder::finishedWhen());
            }

            return $query;
        });
    }

    /**
     * Get the filter's available options.
     *
     * @return array
     */
    public function options(NovaRequest $request)
    {
        return [
            '입고&정산완료&삭제 제외' => 'except_warehoused_confirmed_deleted',
        ];
    }

    public function default()
    {
        return [
            'except_warehoused_confirmed_deleted' => true,
        ];
    }
}
