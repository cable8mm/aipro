<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
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
    public static $title = 'name';

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
            BelongsTo::make('Supplier'),
            Text::make('Good Code')->maxlength(100),
            Text::make('Supplier Category')->maxlength(100),
            Text::make('Name')->maxlength(191),
            Text::make('Origin')->maxlength(100),
            Text::make('Maker')->maxlength(100),
            Text::make('Brand')->maxlength(100),
            Number::make('Box Count')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Number::make('Quantity In Box')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Number::make('Min Order Count')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Text::make('Barcode')->maxlength(100),
            Text::make('Spec')->maxlength(191),
            Number::make('Inventory')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Textarea::make('Description')->alwaysShow(),
            Currency::make('Price'),
            Currency::make('Suggested Selling Price'),
            Currency::make('Suggestioned Retail Price'),
            Currency::make('Supplier Monitoring Price'),
            Textarea::make('Additional Information')->alwaysShow(),
            Boolean::make('Is Runout'),
            Boolean::make('Is Warehoused'),
            Boolean::make('Is Shutdowned'),
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
