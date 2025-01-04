<?php

namespace App\Nova;

use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class MismatchedOrderShipment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\MismatchedOrderShipment>
     */
    public static $model = \App\Models\MismatchedOrderShipment::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'Mismatched Order Shipments';

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
            Number::make('Ct Order Sheet Invoice Id'),
            Text::make('Order_no')->maxlength(65535),
            Text::make('Site')->maxlength(65535),
            Text::make('Master_goods_cd')->maxlength(65535),
            Text::make('Goods_nm')->maxlength(65535),
            Text::make('Option')->maxlength(65535),
            Text::make('Json'),
            Number::make('Cms Maestro Id'),
            Text::make('Status')->maxlength(65535),
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
