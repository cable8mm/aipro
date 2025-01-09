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
            BelongsTo::make(__('User'), 'user', User::class),
            BelongsTo::make(__('Supplier'), 'supplier', Supplier::class),
            BelongsTo::make(__('Supplier Good'), 'supplierGood', SupplierGood::class),
            BelongsTo::make(__('Box'), 'box', Box::class),
            Text::make(__('List Image'), 'list_image')->maxlength(190),
            Text::make(__('Master Code'), 'master_code')->maxlength(255),
            BelongsTo::make(__('Playauto Category'), 'playautoCategory', PlayautoCategory::class),
            Text::make(__('Name'), 'name')->maxlength(255),
            Text::make(__('Godo Name'), 'godo_name')->maxlength(255),
            Text::make(__('Option'), 'option')->maxlength(100),
            Number::make(__('Inventory'), 'inventory')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Number::make(__('Supplier Out Of Stock Count'), 'supplier_out_of_stock_count')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Textarea::make(__('Manual Add Inventory Memo'), 'manual_add_inventory_memo')->alwaysShow(),
            Number::make(__('Safe Inventory'), 'safe_inventory')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Text::make(__('Safe Class'), 'safe_class'),
            Text::make(__('Center Class'), 'center_class'),
            Text::make(__('Category'), 'category')->maxlength(255),
            Text::make(__('Maker'), 'maker')->maxlength(255),
            Text::make(__('Brand'), 'brand')->maxlength(191),
            Currency::make(__('Cost Price'), 'cost_price'),
            Currency::make(__('Last Cost Price'), 'last_cost_price'),
            Currency::make(__('Suggested Selling Price'), 'suggested_selling_price'),
            Currency::make(__('Suggestioned Retail Price'), 'suggestioned_retail_price'),
            Currency::make(__('Supplier Monitoring Price'), 'supplier_monitoring_price'),
            Text::make(__('Supplier Monitoring Status'), 'supplier_monitoring_status')->maxlength(10),
            Boolean::make(__('Supplier Monitoring Interruption'), 'supplier_monitoring_interruption'),
            Currency::make(__('Goods Price'), 'goods_price'),
            Text::make(__('Spec'), 'spec')->maxlength(255),
            Text::make(__('Order Rule'), 'order_rule')->maxlength(255),
            Text::make(__('Barcode'), 'barcode')->maxlength(255),
            Text::make(__('Picking Box Number'), 'picking_box_number')->maxlength(255),
            Text::make(__('Goods Division Color'), 'goods_division_color')->maxlength(255),
            Number::make(__('Ship Quantity'), 'ship_quantity')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Textarea::make(__('Memo'), 'memo')->alwaysShow(),
            Textarea::make(__('Memo For Center'), 'memo_for_center')->alwaysShow(),
            Text::make(__('Naver Category'), 'naver_category'),
            Text::make(__('Naver Productid'), 'naver_productid')->maxlength(128),
            Boolean::make(__('Naver Lowest Price Wrong'), 'naver_lowest_price_wrong'),
            Currency::make(__('Naver Lowest Price'), 'naver_lowest_price'),
            Currency::make(__('Internet Lowest Price'), 'internet_lowest_price'),
            Currency::make(__('Zero Margin Price'), 'zero_margin_price'),
            Boolean::make(__('Is Supplier Out Of Stock'), 'is_supplier_out_of_stock'),
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
        return __('Good');
    }
}
