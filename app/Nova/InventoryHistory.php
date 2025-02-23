<?php

namespace App\Nova;

use App\Enums\InventoryHistory as EnumsInventoryHistory;
use App\Enums\SafeClass;
use App\Traits\NovaAuthorizedByNone;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class InventoryHistory extends Resource
{
    use NovaAuthorizedByNone;

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
            Text::make(__('SKU'), 'item.sku')->exceptOnForms(),
            BelongsTo::make(__('Author'), 'author', User::class)->exceptOnForms(),
            Select::make(__('Safe Class'), 'item.safe_class')->options(SafeClass::array())->displayUsingLabels()->exceptOnForms(),
            BelongsTo::make(__('Item'), 'item', Item::class),
            Select::make(__('Type'), 'type')
                ->rules('required')->required()
                ->options(EnumsInventoryHistory::array())
                ->displayUsingLabels()
                ->filterable()
                ->hideFromIndex(),
            Badge::make(__('Type'), 'type')
                ->map(EnumsInventoryHistory::array(value: 'success'))
                ->labels(EnumsInventoryHistory::array())
                ->onlyOnIndex(),
            MorphTo::make(__('Inventory Historyable'), 'historyable')
                ->types([
                    RetailPurchaseItem::class,
                    OrderShipment::class,
                ]),
            Number::make(__('Quantity'), 'quantity')->displayUsing(function ($value) {
                return number_format($value);
            })->rules('required')->required(),
            Number::make(__('After Quantity'), 'after_quantity')->displayUsing(function ($value) {
                return number_format($value);
            })->rules('required')->required(),
            Number::make(__('Cancel Id'), 'cancel_id'),
            BelongsTo::make(__('Cancel Id'), 'bySelf', InventoryHistory::class),
            Boolean::make(__('Is Success'), 'is_success')->rules('required')->required(),
            DateTime::make(__('Created At'), 'created_at')->exceptOnForms(),
            DateTime::make(__('Updated At'), 'updated_at')->exceptOnForms(),
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
        return __('Item Inventory History');
    }

    public function title()
    {
        return __('Item Inventory History').' #'.$this->id;
    }
}
