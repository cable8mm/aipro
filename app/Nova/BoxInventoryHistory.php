<?php

namespace App\Nova;

use App\Enums\InventoryHistoryType;
use App\Nova\Actions\CancellingInventoryHistory;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class BoxInventoryHistory extends Resource
{
    public static $globallySearchable = false;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\BoxInventoryHistory>
     */
    public static $model = \App\Models\BoxInventoryHistory::class;

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
        'box.sku',
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

            Text::make(__('SKU'), 'box.sku')->exceptOnForms(),

            BelongsTo::make(__('Box'), 'box', Box::class),

            Status::make(__('Type'), 'type')
                ->loadingWhen(InventoryHistoryType::loadingWhen())
                ->failedWhen(InventoryHistoryType::failedWhen())
                ->displayUsing(function ($value) {
                    return InventoryHistoryType::tryFrom($value)?->value() ?? '-';
                }),

            MorphTo::make(__('Inventory Historyable'), 'historyable')
                ->types([
                    BoxPurchaseOrderItem::class,
                    Order::class,
                ]),

            Number::make(__('Quantity'), 'quantity')->rules('required')->required()->displayUsing(function ($value) {
                return number_format($value);
            }),

            Number::make(__('After Quantity'), 'after_quantity')->displayUsing(function ($value) {
                return number_format($value);
            })->rules('required')->required()->exceptOnForms(),

            BelongsTo::make(__('Cancel'), 'cancel', BoxInventoryHistory::class)
                ->nullable()->exceptOnForms(),

            DateTime::make(__('Action Happened At'), 'created_at')->exceptOnForms()->showOnPreview(),
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
        return __('Box Inventory History');
    }

    public function title()
    {
        return __('Box Inventory History').'#'.$this->id;
    }
}
