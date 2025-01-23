<?php

namespace App\Nova;

use App\Enums\CenterClass;
use App\Enums\GoodColor;
use App\Enums\SafeClass;
use App\Nova\Filters\InventoryCountFilter;
use App\Traits\NovaAuthorizedByManager;
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

class Good extends Resource
{
    use NovaAuthorizedByManager;

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
        'name',
        'master_code',
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
            Image::make(__('List Image'), 'list_image'),
            Text::make(__('Master Code'), 'master_code')->rules('required')->required()->maxlength(255)->sortable(),
            Boolean::make(__('Is Shutdown'), 'is_shutdown')->filterable(),

            BelongsTo::make(__('Supplier'), 'supplier', Supplier::class)->filterable(),
            Stack::make(__('Name').' & '.__('Godo Name'), [
                Text::make(__('Name'), fn () => '공급사 : '.$this->name.' x'.$this->ship_quantity)->rules('required')->required()->maxlength(255),
                Text::make(__('Godo Name'), fn () => '자사몰 : '.$this->godo_name.' x'.$this->ship_quantity)->maxlength(255),
            ]),

            Text::make(__('Picking Box Number'), 'picking_box_number')->maxlength(255),
            Select::make(__('Goods Division Color'), 'goods_division_color')->options(GoodColor::array())->displayUsingLabels(),
            Number::make(__('Inventory'), 'inventory')->displayUsing(function ($value) {
                return number_format($value);
            })->sortable(),
            Number::make(__('Safe Inventory'), 'safe_inventory')->displayUsing(function ($value) {
                return number_format($value);
            })->rules('required')->required()->sortable(),

            Stack::make(__('Safe Class').' & '.__('Center Class'), [
                Select::make(__('Safe Class'), 'safe_class')->rules('required')->required()->options(SafeClass::array())->displayUsingLabels()->filterable()->sortable(),
                Select::make(__('Center Class'), 'center_class')->rules('required')->required()->options(CenterClass::array())->displayUsingLabels()->filterable()->sortable(),
            ]),

            Currency::make(__('Cost Price'), 'cost_price'),
            Currency::make(__('Last Cost Price'), 'last_cost_price')->exceptOnForms(),
            Currency::make(__('Goods Price'), 'goods_price'),

            BelongsTo::make(__('Author'), 'author', User::class),

            BelongsTo::make(__('Supplier Good'), 'supplierGood', SupplierGood::class)->hideFromIndex(),
            BelongsTo::make(__('Box'), 'box', Box::class)->hideFromIndex(),
            BelongsTo::make(__('Playauto Category'), 'playautoCategory', PlayautoCategory::class)->hideFromIndex(),
            Text::make(__('Option'), 'option')->maxlength(100)->sortable()->hideFromIndex(),
            Text::make(__('Category'), 'category')->maxlength(255)->filterable()->sortable()->hideFromIndex(),
            Text::make(__('Maker'), 'maker')->maxlength(255)->filterable()->sortable()->hideFromIndex(),
            Text::make(__('Brand'), 'brand')->maxlength(191)->filterable()->sortable()->hideFromIndex(),
            Currency::make(__('Suggested Selling Price'), 'suggested_selling_price')->hideFromIndex(),
            Currency::make(__('Suggested Retail Price'), 'suggested_retail_price')->hideFromIndex(),
            Currency::make(__('Supplier Monitoring Price'), 'supplier_monitoring_price')->hideFromIndex(),
            Text::make(__('Supplier Monitoring Status'), 'supplier_monitoring_status')->maxlength(10)->hideFromIndex(),
            Boolean::make(__('Supplier Monitoring Interruption'), 'supplier_monitoring_interruption')->hideFromIndex(),
            Text::make(__('Spec'), 'spec')->maxlength(255)->hideFromIndex(),
            Text::make(__('Order Rule'), 'order_rule')->maxlength(255)->hideFromIndex(),
            Text::make(__('Barcode'), 'barcode')->maxlength(255)->hideFromIndex(),
            Textarea::make(__('Memo'), 'memo')->alwaysShow()->hideFromIndex(),
            Text::make(__('Naver Category'), 'naver_category')->hideFromIndex(),
            Text::make(__('Naver Productid'), 'naver_productid')->maxlength(128)->hideFromIndex(),
            Boolean::make(__('Naver Lowest Price Wrong'), 'naver_lowest_price_wrong')->hideFromIndex(),
            Currency::make(__('Naver Lowest Price'), 'naver_lowest_price')->exceptOnForms()->hideFromIndex(),
            Currency::make(__('Internet Lowest Price'), 'internet_lowest_price')->exceptOnForms()->hideFromIndex(),
            Currency::make(__('Zero Margin Price'), 'zero_margin_price')->exceptOnForms()->hideFromIndex(),
            Boolean::make(__('Is Supplier Out Of Stock'), 'is_supplier_out_of_stock')->hideFromIndex(),
            Boolean::make(__('Can Be Shipped'), 'can_be_shipped')->filterable()->hideFromIndex(),
            Stack::make(__('Created At').' & '.__('Updated At'), [
                DateTime::make(__('Created At'), 'created_at'),
                DateTime::make(__('Updated At'), 'updated_at'),
            ])->hideFromIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            new Metrics\GoodSumCostPrice,
            new Metrics\SellGoodsPerSafeClass,
            new Metrics\GoodsPerShutdown,
        ];
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
        return __('Good');
    }

    public function title()
    {
        return '['.$this->master_code.'] '.$this->name;
    }
}
