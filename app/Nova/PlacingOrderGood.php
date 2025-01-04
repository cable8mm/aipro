<?php

namespace App\Nova;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
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
    public static $title = 'Placing Order Goods';

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
            Number::make('Ct Order Id'),
            Number::make('Cms Maestro Id'),
            Number::make('Ct Good Id'),
            Number::make('Warehouse Manager Id'),
            Number::make('Order Count'),
            Number::make('Order Price'),
            Number::make('Supplier Confirmed Count'),
            Number::make('Supplier Confirmed Price'),
            Number::make('Cost Count'),
            Number::make('Cost Promotion Count'),
            Number::make('Cost Price'),
            Boolean::make('Is Promotion'),
            DateTime::make('Warehoused'),
            Text::make('Status')->maxlength(65535),
            Text::make('Memo'),
            DateTime::make('Ordered'),
            DateTime::make('Created At'),
            DateTime::make('Updated At'),
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
