<?php

namespace App\Nova;

use App\Enums\InventoryHistoryType;
use App\Enums\ItemInventoryLevel;
use App\Nova\Actions\CancellingInventoryHistory;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class InventoryHistory extends Resource
{
    public static $globallySearchable = false;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\InventoryHistory>
     */
    public static $model = \App\Models\InventoryHistory::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

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
            BelongsTo::make(__('Author'), 'author', User::class)->exceptOnForms(),
            Text::make(__('SKU'), 'item.sku')->exceptOnForms(),
            Select::make(__('Inventory Level'), 'item.inventory_level')->options(ItemInventoryLevel::array())->displayUsingLabels()->exceptOnForms(),
            BelongsTo::make(__('Item'), 'item', Item::class),
            Status::make(__('Type'), 'type')
                ->loadingWhen(InventoryHistoryType::loadingWhen())
                ->failedWhen(InventoryHistoryType::failedWhen())
                ->displayUsing(function ($value) {
                    return InventoryHistoryType::{$value}->value() ?? '-';
                }),
            MorphTo::make(__('Inventory Historyable'), 'historyable')
                ->types([
                    ItemManualWarehousing::class,
                    RetailPurchaseItem::class,
                    OrderShipment::class,
                ]),
            Number::make(__('Quantity'), 'quantity')->displayUsing(function ($value) {
                return number_format($value);
            })->rules('required')->required(),
            Number::make(__('After Quantity'), 'after_quantity')->displayUsing(function ($value) {
                return number_format($value);
            })->rules('required')->required(),
            BelongsTo::make(__('Cancel'), 'cancel', InventoryHistory::class),
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
        return [
            (new CancellingInventoryHistory)->showInline(),
        ];
    }

    public static function label()
    {
        return __('Item Inventory History');
    }

    public function title()
    {
        return __('Item Inventory History').'#'.$this->id;
    }
}
