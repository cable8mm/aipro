<?php

namespace App\Nova;

use App\Enums\ItemInventoryLevel;
use App\Enums\ItemStatus;
use App\Enums\SupplierPricingPolicy;
use App\Models\Location as ModelsLocation;
use App\Models\Supplier as ModelsSupplier;
use App\Nova\Filters\InventoryCountFilter;
use App\Traits\NovaAuthorizedByManager;
use Cable8mm\GoodCode\Sku;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
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
        'supplier.name',
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
            BelongsTo::make(__('Location'), 'location', Location::class)
                ->default(ModelsLocation::oldest()->first()->id),
            Text::make(__('SKU'), 'sku')
                ->rules('required')->required()->maxlength(255)
                ->sortable()
                ->default(Sku::of(Item::latestOne()->id)->sku()),
            Number::make(__('Units Per Case'), 'units_per_case')
                ->rules('required')->required()
                ->default(1),
            BelongsTo::make(__('Supplier'), 'supplier', Supplier::class)
                ->rules('required')->required()->filterable()
                ->default(ModelsSupplier::latest()->first()->id),
            Text::make(__('Name'), 'name')
                ->rules('required')->required()->maxlength(255),
            Number::make(__('Inventory'), 'inventory')->displayUsing(function ($value) {
                return number_format($value);
            })->rules('required')->required()->sortable()->default(0),
            Select::make(__('Status'), 'status')->options(ItemStatus::array())
                ->rules('required')->required()
                ->default(ItemStatus::ACTIVE->value)->onlyOnForms(),
            Panel::make(__('Additional Information'), [
                Number::make(__('Safe Inventory'), 'safe_inventory')->displayUsing(function ($value) {
                    return number_format($value);
                })->rules('required')->required()->sortable()
                    ->default(20),
                Select::make(__('Inventory Level'), 'inventory_level')->rules('required')
                    ->required()->options(ItemInventoryLevel::array())->displayUsingLabels()
                    ->filterable()->sortable(),
                Currency::make(__('Cost Price'), 'cost_price')
                    ->rules('required')->required()
                    ->default(50000),
                Currency::make(__('Last Cost Price'), 'last_cost_price')->exceptOnForms(),
                Currency::make(__('Zero Margin Price'), 'zero_margin_price')
                    ->hideFromDetail()->hideFromIndex()->exceptOnForms(),
                Currency::make(__('Suggested Selling Price'), 'suggested_selling_price')
                    ->hideFromDetail()->hideFromIndex()->exceptOnForms(),
                Select::make(__('Supplier Pricing Policy'), 'supplier_pricing_policy')->options(SupplierPricingPolicy::array())
                    ->rules('required')->required()
                    ->default(SupplierPricingPolicy::FLEXIBLE->name)
                    ->displayUsing(function ($value) {
                        return SupplierPricingPolicy::{$value}->value() ?? '-';
                    }),
                Currency::make(__('Max Price'), 'max_price'),
                Currency::make(__('Min Price'), 'min_price'),
                Boolean::make(__('Terminate On Pricing Violation'), 'terminate_on_pricing_violation'),
                Text::make(__('Spec'), 'spec')
                    ->maxlength(255)
                    ->help('e.g. 5g*10p')
                    ->hideFromIndex(),
                Text::make(__('Order Rule'), 'order_rule')->maxlength(255)->hideFromIndex(),
                Text::make(__('Barcode'), 'barcode')->maxlength(255)->hideFromIndex(),
                Textarea::make(__('Memo'), 'memo')->alwaysShow()->hideFromIndex(),
                DateTime::make(__('Discontinued At'), 'discontinued_at')
                    ->hideFromIndex()->onlyOnDetail(),
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
