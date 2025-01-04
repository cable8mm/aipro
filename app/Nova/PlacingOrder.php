<?php

namespace App\Nova;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class PlacingOrder extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PlacingOrder>
     */
    public static $model = \App\Models\PlacingOrder::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'Placing Orders';

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
            Number::make('Cms Maestro Id'),
            Number::make('Warehouse Manager Id'),
            Number::make('Ct Supplier Id'),
            Text::make('Title')->maxlength(65535),
            Date::make('Order Date'),
            Number::make('Total Good Count'),
            Number::make('Total Order Price'),
            Number::make('Order Discount Percent'),
            Boolean::make('Is Applied Order Discount Percent'),
            DateTime::make('Sent'),
            DateTime::make('Confirmed'),
            Date::make('Predict Warehoused'),
            DateTime::make('Warehoused'),
            Text::make('Status')->maxlength(65535),
            Text::make('Memo'),
            DateTime::make('Created'),
            DateTime::make('Modified'),
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
