<?php

namespace App\Nova;

use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SupplierGoodsBak extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\SupplierGoodsBak>
     */
    public static $model = \App\Models\SupplierGoodsBak::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'Supplier Goods Bak';

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
            Number::make('Ct Supplier Id'),
            Text::make('Code')->maxlength(65535),
            Text::make('Name')->maxlength(65535),
            Text::make('Previous Name')->maxlength(65535),
            Number::make('Box Count'),
            Number::make('Cost Price Without Vat'),
            Number::make('Cost Price With Vat'),
            Number::make('Suggest Good Price'),
            Number::make('Customer Good Price'),
            Text::make('Additional Information')->maxlength(65535),
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
