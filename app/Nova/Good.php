<?php

namespace App\Nova;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
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
    public static $title = 'Goods';

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
            Number::make('Ct Supplier Id'),
            Number::make('Ct Supplier Good Id'),
            Number::make('Ct Box Id'),
            Text::make('List Image')->maxlength(65535),
            Number::make('Godo Code'),
            Text::make('Retail Code')->maxlength(65535),
            Text::make('Playauto Master Code')->maxlength(65535),
            Text::make('Center Code')->maxlength(65535),
            Number::make('Playauto Category Id'),
            Text::make('Name')->maxlength(65535),
            Text::make('Godo Name')->maxlength(65535),
            Text::make('Option')->maxlength(65535),
            Number::make('Inventory'),
            Number::make('Supplier Out Of Stock Count'),
            Text::make('Manual Add Inventory Memo'),
            Number::make('Safe Inventory'),
            Text::make('Safe Class'),
            Text::make('Center Class'),
            Text::make('Category')->maxlength(65535),
            Text::make('Maker')->maxlength(65535),
            Text::make('Brand')->maxlength(65535),
            Number::make('Cost Price'),
            Number::make('Last Cost Price'),
            Number::make('Suggested Selling Price'),
            Number::make('Suggestioned Retail Price'),
            Number::make('Supplier Monitoring Price'),
            Text::make('Supplier Monitoring Status')->maxlength(65535),
            Boolean::make('Supplier Monitoring Interruption'),
            Number::make('Goods Price'),
            Number::make('Goods Price Wemake2'),
            Number::make('Goods Price Holapetshop'),
            Text::make('Supplier Name')->maxlength(65535),
            Number::make('Supplier Request Price'),
            Text::make('Supplier Good Code')->maxlength(65535),
            Text::make('Spec')->maxlength(65535),
            Text::make('Order Rule')->maxlength(65535),
            Text::make('Barcode Type')->maxlength(65535),
            Text::make('Barcode')->maxlength(65535),
            Text::make('Generated Barcode')->maxlength(65535),
            Text::make('Picking Box Number')->maxlength(65535),
            Text::make('Storage Box Zone')->maxlength(65535),
            Text::make('Goods Division Color')->maxlength(65535),
            Number::make('Ship Quantity'),
            Text::make('Memo'),
            Text::make('Memo For Center')->maxlength(65535),
            Text::make('Good Classification')->maxlength(65535),
            Text::make('Print Classification')->maxlength(65535),
            Text::make('Naver Category'),
            Text::make('Naver Productid')->maxlength(65535),
            Boolean::make('Not Exist Naver Productid'),
            Boolean::make('Naver Lowest Price Wrong'),
            Number::make('Naver Lowest Price'),
            Number::make('Internet Lowest Price'),
            Number::make('Zero Margin Price'),
            Number::make('Suggested Sales Percent Margin'),
            Number::make('Suggested Selling Price Of Gms'),
            Boolean::make('Is Hi300'),
            Boolean::make('Is Supplier Out Of Stock'),
            Boolean::make('Is My Shop Sale'),
            Boolean::make('Is Other Shop Sale'),
            Boolean::make('Is Not Playauto Used'),
            Boolean::make('Is Playauto Done'),
            Boolean::make('Is Requested Shutdown'),
            Boolean::make('Is Requested Reborn'),
            Boolean::make('Is Shutdowned'),
            Boolean::make('Is Scm Manager Confirmed'),
            DateTime::make('Last Warehoused'),
            DateTime::make('Supplier Out Of Stock On Datetime'),
            DateTime::make('Supplier Out Of Stock Off Datetime'),
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
