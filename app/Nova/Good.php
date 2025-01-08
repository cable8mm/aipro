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

class Good extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Good>
     */
    public static $model = \App\Models\Good::class;

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
            BelongsTo::make('User'),
            BelongsTo::make('Supplier'),
            BelongsTo::make('Supplier Good'),
            BelongsTo::make('Box'),
            Text::make('List Image')->maxlength(190),
            Text::make('Master Code')->maxlength(255),
            BelongsTo::make('Playauto Category'),
            Text::make('Name')->maxlength(255),
            Text::make('Godo Name')->maxlength(255),
            Text::make('Option')->maxlength(100),
            Number::make('Inventory')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Number::make('Supplier Out Of Stock Count')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Textarea::make('Manual Add Inventory Memo')->alwaysShow(),
            Number::make('Safe Inventory')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Text::make('Safe Class'),
            Text::make('Center Class'),
            Text::make('Category')->maxlength(255),
            Text::make('Maker')->maxlength(255),
            Text::make('Brand')->maxlength(191),
            Currency::make('Cost Price'),
            Currency::make('Last Cost Price'),
            Currency::make('Suggested Selling Price'),
            Currency::make('Suggestioned Retail Price'),
            Currency::make('Supplier Monitoring Price'),
            Text::make('Supplier Monitoring Status')->maxlength(10),
            Boolean::make('Supplier Monitoring Interruption'),
            Currency::make('Goods Price'),
            Text::make('Spec')->maxlength(255),
            Text::make('Order Rule')->maxlength(255),
            Text::make('Barcode')->maxlength(255),
            Text::make('Picking Box Number')->maxlength(255),
            Text::make('Goods Division Color')->maxlength(255),
            Number::make('Ship Quantity'),
            Textarea::make('Memo')->alwaysShow(),
            Textarea::make('Memo For Center')->alwaysShow(),
            Text::make('Naver Category'),
            Text::make('Naver Productid')->maxlength(128),
            Boolean::make('Naver Lowest Price Wrong'),
            Currency::make('Naver Lowest Price'),
            Currency::make('Internet Lowest Price'),
            Currency::make('Zero Margin Price'),
            Boolean::make('Is Supplier Out Of Stock'),
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
