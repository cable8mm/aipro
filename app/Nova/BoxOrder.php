<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class BoxOrder extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\BoxOrder>
     */
    public static $model = \App\Models\BoxOrder::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

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
            BelongsTo::make(__('User'), 'user', User::class),
            BelongsTo::make(__('Warehouse Manager'), 'warehouseManager', User::class),
            BelongsTo::make(__('Box Supplier'), 'boxSupplier', BoxSupplier::class),
            Text::make(__('Title'), 'title')->maxlength(190),
            Number::make(__('Total Box Count'), 'total_box_count')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Currency::make(__('Total Order Price'), 'total_order_price'),
            DateTime::make(__('Ordered At'), 'ordered_at'),
            DateTime::make(__('Sent At'), 'sent_at'),
            DateTime::make(__('Confirmed At'), 'confirmed_at'),
            DateTime::make(__('Predict Warehoused At'), 'predict_warehoused_at'),
            DateTime::make(__('Warehoused At'), 'warehoused_at'),
            Status::make(__('Status'), 'status')
                ->loadingWhen(['미처리'])
                ->failedWhen([]),
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
        return __('Box Order');
    }
}
