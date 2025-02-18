<?php

namespace App\Nova;

use App\Enums\OrderType;
use App\Nova\Actions\PrintOrder;
use App\Traits\NovaAuthorizedByWarehouser;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasManyThrough;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MultiSelect;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Order extends Resource
{
    use NovaAuthorizedByWarehouser;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Order>
     */
    public static $model = \App\Models\Order::class;

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
        'orderSheetWaybill.id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make(__('Order Number'), 'id')->sortable(),
            BelongsTo::make(__('Order Sheet Waybill'), 'orderSheetWaybill', OrderSheetWaybill::class),
            MultiSelect::make(__('Type'), 'type')->options(OrderType::array())
                ->rules('required')->required()->displayUsingLabels()->filterable(),
            Number::make(__('Order Good Count'), 'order_good_count')->displayUsing(function ($value) {
                return number_format($value);
            })->exceptOnForms(),
            BelongsTo::make(__('Box'), 'box', Box::class),
            Number::make(__('Box Quantity'), 'box_quantity'),
            Number::make(__('Printed Count'), 'printed_count')->displayUsing(function ($value) {
                return number_format($value);
            })->exceptOnForms(),
            Text::make(__('Waybill Numbers'), 'waybill_numbers'),
            DateTime::make(__('Created At'), 'created_at')->exceptOnForms(),
            DateTime::make(__('Updated At'), 'updated_at')->exceptOnForms(),

            HasMany::make(__('Order Shipments'), 'orderShipments', OrderShipment::class),

            HasManyThrough::make(__('Items'), 'items', Item::class),
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
            (new PrintOrder)->showInline(),
        ];
    }

    public static function label()
    {
        return __('Orders');
    }
}
