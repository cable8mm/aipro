<?php

namespace App\Nova;

use App\Enums\InventoryHistoryType;
use App\Traits\NovaAuthorizedByNone;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class BoxInventoryHistory extends Resource
{
    use NovaAuthorizedByNone;

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
            Select::make(__('Type'), 'type')
                ->rules('required')->required()
                ->options(InventoryHistoryType::array())
                ->displayUsingLabels()
                ->filterable()
                ->hideFromIndex(),
            Badge::make(__('Type'), 'type')
                ->map(InventoryHistoryType::array(value: 'success'))
                ->labels(InventoryHistoryType::array())
                ->onlyOnIndex(),
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
            })->rules('required')->required(),
            BelongsTo::make(__('Cancel'), 'cancel', BoxInventoryHistory::class),
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
        return __('Box Inventory History');
    }
}
