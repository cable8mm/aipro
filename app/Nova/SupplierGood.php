<?php

namespace App\Nova;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SupplierGood extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\SupplierGood>
     */
    public static $model = \App\Models\SupplierGood::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'Supplier Goods';

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
            Text::make('Good Code')->maxlength(100),
            Text::make('Center Code')->maxlength(100),
            Text::make('Supplier Attribute')->maxlength(50),
            Text::make('Supplier Category')->maxlength(100),
            Text::make('Godo Name')->maxlength(191),
            Text::make('Gn')->maxlength(191),
            Text::make('Name')->maxlength(191),
            Text::make('Origin')->maxlength(100),
            Text::make('Maker')->maxlength(100),
            Text::make('Brand')->maxlength(100),
            Number::make('Box Count'),
            Number::make('Quantity In Box'),
            Text::make('Min Order Count')->maxlength(191),
            Text::make('Current Barcode')->maxlength(191),
            Text::make('Barcode')->maxlength(100),
            Text::make('Box Barcode')->maxlength(50),
            Text::make('Spec')->maxlength(191),
            Number::make('Inventory'),
            Text::make('Description'),
            Number::make('Price'),
            Number::make('Suggested Selling Price'),
            Number::make('Suggestioned Retail Price'),
            Number::make('Supplier Monitoring Price'),
            Date::make('Ead'),
            Text::make('Additional Information'),
            Boolean::make('Is Information Manual Sync'),
            Boolean::make('Is Runout'),
            Boolean::make('Is Warehoused'),
            Boolean::make('Is Shutdowned'),
            Date::make('Supplier Created'),
            Date::make('Supplier Modified'),
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
