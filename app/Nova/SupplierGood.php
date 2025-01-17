<?php

namespace App\Nova;

use App\Traits\NovaAuthorizedByWarehouser;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class SupplierGood extends Resource
{
    use NovaAuthorizedByWarehouser;

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
        'name',
        'good_code',
        'barcode',
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
            BelongsTo::make(__('Supplier'), 'supplier', Supplier::class)->filterable(),
            Text::make(__('Good Code'), 'good_code')->maxlength(100),
            Text::make(__('Supplier Category'), 'supplier_category')->maxlength(100),
            Text::make(__('Name'), 'name')->maxlength(191),
            Country::make(__('Origin'), 'origin')->displayUsingLabels()->default('KR')->hideFromIndex(),
            Text::make(__('Maker'), 'maker')->maxlength(100)->hideFromIndex(),
            Text::make(__('Brand'), 'brand')->maxlength(100)->hideFromIndex(),
            Number::make(__('Box Count'), 'box_count')->displayUsing(function ($value) {
                return number_format($value);
            })->hideFromIndex(),
            Number::make(__('Quantity In Box'), 'quantity_in_box')->displayUsing(function ($value) {
                return number_format($value);
            })->hideFromIndex(),
            Number::make(__('Min Order Count'), 'min_order_count')->displayUsing(function ($value) {
                return number_format($value);
            })->hideFromIndex(),
            Text::make(__('Barcode'), 'barcode')->maxlength(100),
            Text::make(__('Spec'), 'spec')->maxlength(191),
            Number::make(__('Inventory'), 'inventory')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Textarea::make(__('Description'), 'description')->alwaysShow(),
            Currency::make(__('Price'), 'price'),
            Currency::make(__('Suggested Selling Price'), 'suggested_selling_price'),
            Currency::make(__('Suggested Retail Price'), 'suggested_retail_price'),
            Currency::make(__('Supplier Monitoring Price'), 'supplier_monitoring_price'),
            Textarea::make(__('Additional Information'), 'additional_information')->alwaysShow(),
            Boolean::make(__('Is Runout'), 'is_runout')->filterable(),
            Boolean::make(__('Is Warehoused'), 'is_warehoused')->filterable(),
            Boolean::make(__('Is Shutdown'), 'is_shutdown')->filterable(),
            Stack::make(__('Created At').' & '.__('Updated At'), [
                DateTime::make(__('Created At'), 'created_at'),
                DateTime::make(__('Updated At'), 'updated_at'),
            ]),
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
