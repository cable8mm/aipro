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
            BelongsTo::make('User'),
            BelongsTo::make('Warehouse Manager', 'warehouseManager', User::class),
            BelongsTo::make('Box Supplier'),
            Text::make('Title')->maxlength(190),
            Number::make('Total Box Count')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Currency::make('Total Order Price'),
            DateTime::make('Ordered At'),
            DateTime::make('Sent At'),
            DateTime::make('Confirmed At'),
            DateTime::make('Predict Warehoused At'),
            DateTime::make('Warehoused At'),
            Status::make('Status')
                ->loadingWhen(['미처리'])
                ->failedWhen([]),
            Textarea::make('Memo')->alwaysShow(),
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
}
