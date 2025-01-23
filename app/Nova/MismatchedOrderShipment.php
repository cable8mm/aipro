<?php

namespace App\Nova;

use App\Enums\Status as EnumsStatus;
use App\Traits\NovaAuthorizedByWarehouser;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class MismatchedOrderShipment extends Resource
{
    use NovaAuthorizedByWarehouser;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\MismatchedOrderShipment>
     */
    public static $model = \App\Models\MismatchedOrderShipment::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'order_no';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'OrderSheetInvoice.id',
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
            BelongsTo::make(__('Author'), 'author', User::class),
            BelongsTo::make(__('Order Sheet Invoice'), 'orderSheetInvoice', OrderSheetInvoice::class),
            Text::make(__('Order No'), 'order_no')->maxlength(100),
            Text::make(__('Site'), 'site')->maxlength(100),
            Text::make(__('Master Goods Cd'), 'master_goods_cd')->maxlength(100),
            Text::make(__('Goods Nm'), 'goods_nm')->maxlength(255),
            Text::make(__('Option'), 'option')->maxlength(255),
            KeyValue::make(__('Json'), 'json'),
            Select::make(__('Status'), 'status')
                ->options(EnumsStatus::array())->displayUsingLabels()->filterable(),
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
        return __('Mismatched Order Shipment');
    }

    public function title()
    {
        return __('Mismatched Order Shipment').' '.'#'.$this->id;
    }
}
