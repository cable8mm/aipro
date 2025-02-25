<?php

namespace App\Nova;

use App\Enums\CenterClass;
use App\Enums\ItemStatus;
use App\Enums\SafeClass;
use App\Nova\Filters\InventoryCountFilter;
use App\Traits\NovaAuthorizedByManager;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class Item extends Resource
{
    use NovaAuthorizedByManager;

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
            BelongsTo::make(__('Location'), 'location', Location::class),
            Text::make(__('SKU'), 'sku')
                ->rules('required')->required()->maxlength(255)
                ->sortable(),
            Number::make(__('Units Per Case'), 'units_per_case'),
            BelongsTo::make(__('Supplier'), 'supplier', Supplier::class)->filterable(),
            Text::make(__('Name'), 'name')
                ->rules('required')->required()->maxlength(255),
            Text::make(__('Godo Name'), 'good.name')
                ->maxlength(255)->onlyOnForms(),
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
                Currency::make(__('Zero Margin Price'), 'zero_margin_price')
                    ->hideFromDetail()->hideFromIndex()->exceptOnForms(),
                Currency::make(__('Suggested Selling Price'), 'suggested_selling_price')
                    ->hideFromDetail()->hideFromIndex()->exceptOnForms(),
                Text::make(__('Spec'), 'spec')->maxlength(255)->hideFromIndex(),
                Text::make(__('Order Rule'), 'order_rule')->maxlength(255)->hideFromIndex(),
                Text::make(__('Barcode'), 'barcode')->maxlength(255)->hideFromIndex(),
                Textarea::make(__('Memo'), 'memo')->alwaysShow()->hideFromIndex(),
                DateTime::make(__('Discontinued At'), 'discontinued_at')->hideFromIndex(),
                Status::make(__('Status'), 'status')
                    ->loadingWhen(ItemStatus::loadingWhen())
                    ->failedWhen(ItemStatus::failedWhen())
                    ->displayUsing(function ($value) {
                        return ItemStatus::{$value}->value() ?? '-';
                    }),
            ])->withToolbar()->limit(3),

            Stack::make(__('Created At').' & '.__('Updated At'), [
                DateTime::make(__('Created At'), 'created_at'),
                DateTime::make(__('Updated At'), 'updated_at'),
            ])->hideFromIndex(),

            HasMany::make(__('Purchase Order Items'), 'purchaseOrderItems', PurchaseOrderItem::class),

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
            new Metrics\ItemsPerStatus,
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
        return __('Item');
    }

    public function title()
    {
        return '['.$this->sku.'] '.$this->name;
    }
}
