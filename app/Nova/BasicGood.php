<?php

namespace App\Nova;

use App\Enums\CenterClass;
use App\Enums\ItemColor;
use App\Enums\SafeClass;
use App\Nova\Filters\InventoryCountFilter;
use App\Traits\NovaAuthorizedByMd;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class BasicGood extends Resource
{
    use NovaAuthorizedByMd;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Item>
     */
    public static $model = \App\Models\Item::class;

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
        'sku',
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
            BelongsTo::make(__('Author'), 'author', User::class)->exceptOnForms(),
            Image::make(__('List Image'), 'list_image'),
            Text::make(__('SKU'), 'sku')
                ->rules('required')->required()
                ->maxlength(100)
                ->copyable(),
            BelongsTo::make(__('Playauto Category'), 'playautoCategory', PlayautoCategory::class),
            Text::make(__('Name'), 'name')->rules('required')->required()->maxlength(255),
            Text::make(__('Godo Name'), 'godo_name')->maxlength(255),
            Text::make(__('Option'), 'option')->maxlength(100)->sortable(),
            Number::make(__('Inventory'), 'inventory')->displayUsing(function ($value) {
                return number_format($value);
            })->sortable(),
            Number::make(__('Safe Inventory'), 'safe_inventory')->displayUsing(function ($value) {
                return number_format($value);
            })->rules('required')->required()->sortable(),
            Select::make(__('Safe Class'), 'safe_class')->rules('required')->required()->options(SafeClass::array())->displayUsingLabels()->filterable()->sortable(),
            Select::make(__('Center Class'), 'center_class')->rules('required')->required()->options(CenterClass::array())->displayUsingLabels()->filterable()->sortable(),
            Text::make(__('Category'), 'category')->maxlength(255)->filterable()->sortable(),
            Text::make(__('Maker'), 'maker')->maxlength(255)->filterable()->sortable(),
            Text::make(__('Brand'), 'brand')->maxlength(191)->filterable()->sortable(),
            Currency::make(__('Cost Price'), 'cost_price'),
            Currency::make(__('Last Cost Price'), 'last_cost_price')->exceptOnForms(),
            Currency::make(__('Suggested Selling Price'), 'suggested_selling_price'),
            Currency::make(__('Suggested Retail Price'), 'suggested_retail_price'),
            Currency::make(__('Supplier Monitoring Price'), 'supplier_monitoring_price'),
            Text::make(__('Supplier Monitoring Status'), 'supplier_monitoring_status')->maxlength(10),
            Boolean::make(__('Supplier Monitoring Interruption'), 'supplier_monitoring_interruption'),
            Currency::make(__('Goods Price'), 'goods_price'),
            Text::make(__('Spec'), 'spec')->maxlength(255),
            Select::make(__('Item Division Color'), 'item_division_color')->options(ItemColor::array())->displayUsingLabels(),
            Number::make(__('Ship Quantity'), 'ship_quantity')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Textarea::make(__('Memo'), 'memo')->alwaysShow(),
            Text::make(__('Naver Category'), 'naver_category'),
            Text::make(__('Naver Productid'), 'naver_productid')->maxlength(128),
            Boolean::make(__('Naver Lowest Price Wrong'), 'naver_lowest_price_wrong'),
            Currency::make(__('Naver Lowest Price'), 'naver_lowest_price')->exceptOnForms(),
            Currency::make(__('Internet Lowest Price'), 'internet_lowest_price')->exceptOnForms(),
            Currency::make(__('Zero Margin Price'), 'zero_margin_price')->exceptOnForms(),
            Boolean::make(__('Is Supplier Out Of Stock'), 'is_supplier_out_of_stock'),
            Boolean::make(__('Can Be Shipped'), 'can_be_shipped')->filterable(),
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
        return [
            new InventoryCountFilter,
        ];
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
        return __('Basic Good');
    }

    public function title()
    {
        return '['.$this->sku.'] '.$this->name;
    }
}
