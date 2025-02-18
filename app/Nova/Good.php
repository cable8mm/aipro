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
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

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
            BelongsTo::make(__('Author'), 'author', User::class)->exceptOnForms(),
            Text::make(__('Master Code'), 'master_code')
                ->rules('required')->required()->maxlength(255)
                ->sortable(),
            BelongsTo::make(__('Supplier'), 'supplier', Supplier::class)->filterable(),
            Stack::make(__('Name').' & '.__('Godo Name'), [
                Line::make(__('Name'), fn () => $this->name.' x'.$this->ship_quantity)
                    ->asHeading(),
                Line::make(__('Godo Name'), fn () => '쇼핑몰 : '.$this->godo_name.' x'.$this->ship_quantity)
                    ->asSmall(),
            ]),
            Text::make(__('Name'), 'name')
                ->rules('required')->required()->maxlength(255)->onlyOnForms(),
            Text::make(__('Godo Name'), 'godo_name')
                ->maxlength(255)->onlyOnForms(),
            Text::make(__('Picking Zone Number'), 'picking_zone_number')->maxlength(255),
            Select::make(__('Goods Division Color'), 'goods_division_color')->options(GoodColor::array())->displayUsingLabels(),
            Number::make(__('Inventory'), 'inventory')->displayUsing(function ($value) {
                return number_format($value);
            })->sortable(),
            Panel::make(__('Additional Information'), [
                Number::make(__('Safe Inventory'), 'safe_inventory')->displayUsing(function ($value) {
                    return number_format($value);
                })->rules('required')->required()->sortable(),

                Stack::make(__('Safe Class').' & '.__('Center Class'), [
                    Select::make(__('Safe Class'), 'safe_class')->rules('required')
                        ->required()->options(SafeClass::array())->displayUsingLabels()
                        ->filterable()->sortable(),
                    Select::make(__('Center Class'), 'center_class')
                        ->rules('required')->required()->options(CenterClass::array())->displayUsingLabels()
                        ->filterable()->sortable(),
                ]),

                Currency::make(__('Cost Price'), 'cost_price'),
                Currency::make(__('Last Cost Price'), 'last_cost_price')->exceptOnForms(),
                Currency::make(__('Goods Price'), 'goods_price'),
                Text::make(__('Option'), 'option')->maxlength(100)->sortable()->hideFromIndex(),
                Currency::make(__('Suggested Selling Price'), 'suggested_selling_price')
                    ->hideFromDetail()->hideFromIndex()->exceptOnForms(),
                Text::make(__('Spec'), 'spec')->maxlength(255)->hideFromIndex(),
                Text::make(__('Order Rule'), 'order_rule')->maxlength(255)->hideFromIndex(),
                Text::make(__('Barcode'), 'barcode')->maxlength(255)->hideFromIndex(),
                Textarea::make(__('Memo'), 'memo')->alwaysShow()->hideFromIndex(),
                Currency::make(__('Zero Margin Price'), 'zero_margin_price')
                    ->hideFromDetail()->hideFromIndex()->exceptOnForms(),
                Boolean::make(__('Can Be Shipped'), 'can_be_shipped')->filterable()
                    ->hideFromIndex(),
                Boolean::make(__('Is Shutdown'), 'is_shutdown')
                    ->filterable(),
            ])->withToolbar()->limit(3),

            Stack::make(__('Created At').' & '.__('Updated At'), [
                DateTime::make(__('Created At'), 'created_at'),
                DateTime::make(__('Updated At'), 'updated_at'),
            ])->hideFromIndex(),

            HasMany::make(__('Placing Order Goods'), 'placingOrderGoods', PlacingOrderGood::class),

            HasMany::make(__('Inventory Histories'), 'inventoryHistories', InventoryHistory::class),
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
