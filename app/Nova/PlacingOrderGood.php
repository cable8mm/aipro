<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class PlacingOrderGood extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PlacingOrderGood>
     */
    public static $model = \App\Models\PlacingOrderGood::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'good_id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make(__('Placing Order'), 'placingOrder', PlacingOrder::class),
            Hidden::make(__('User'), 'user')->default(function ($request) {
                return $request->user()->id;
            }),
            BelongsTo::make(__('Good'), 'good', Good::class),
            BelongsTo::make(__('Warehouse Manager'), 'warehouseManager', User::class),
            Number::make(__('Order Count'), 'order_count')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Currency::make(__('Order Price'), 'order_price'),
            Number::make(__('Supplier Confirmed Count'), 'supplier_confirmed_count')->displayUsing(function ($value) {
                return number_format($value);
            })->exceptOnForms(),
            Currency::make(__('Supplier Confirmed Price'), 'supplier_confirmed_price')->exceptOnForms(),
            DateTime::make(__('Warehoused At'), 'warehoused_at'),
            Status::make(__('Status'), 'status')
                ->loadingWhen(['waiting', 'running'])
                ->failedWhen(['failed']),
            Textarea::make(__('Memo'), 'memo')->alwaysShow(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    public static function label()
    {
        return __('Placing Order Good');
    }
}
