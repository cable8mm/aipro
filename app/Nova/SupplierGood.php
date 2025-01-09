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
            BelongsTo::make(__('Supplier'), 'supplier', Supplier::class),
            Text::make(__('Good Code'), 'good_code')->maxlength(100),
            Text::make(__('Supplier Category'), 'supplier_category')->maxlength(100),
            Text::make(__('Name'), 'name')->maxlength(191),
            Text::make(__('Origin'), 'origin')->maxlength(100),
            Text::make(__('Maker'), 'maker')->maxlength(100),
            Text::make(__('Brand'), 'brand')->maxlength(100),
            Number::make(__('Box Count'), 'box_count')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Number::make(__('Quantity In Box'), 'quantity_in_box')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Number::make(__('Min Order Count'), 'min_order_count')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Text::make(__('Barcode'), 'barcode')->maxlength(100),
            Text::make(__('Spec'), 'spec')->maxlength(191),
            Number::make(__('Inventory'), 'inventory')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Textarea::make(__('Description'), 'description')->alwaysShow(),
            Currency::make(__('Price'), 'price'),
            Currency::make(__('Suggested Selling Price'), 'suggested_selling_price'),
            Currency::make(__('Suggestioned Retail Price'), 'suggestioned_retail_price'),
            Currency::make(__('Supplier Monitoring Price'), 'supplier_monitoring_price'),
            Textarea::make(__('Additional Information'), 'additional_information')->alwaysShow(),
            Boolean::make(__('Is Runout'), 'is_runout'),
            Boolean::make(__('Is Warehoused'), 'is_warehoused'),
            Boolean::make(__('Is Shutdowned'), 'is_shutdowned'),
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
        return __('Supplier Good');
    }
}
