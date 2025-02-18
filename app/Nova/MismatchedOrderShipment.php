<?php

namespace App\Nova;

use App\Enums\MismatchedStatus;
use App\Nova\Actions\ChangeStatusAction;
use App\Traits\NovaAuthorizedByWarehouser;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Status;
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
        'OrderSheetWaybill.id',
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
            BelongsTo::make(__('Order Sheet Waybill'), 'orderSheetWaybill', OrderSheetWaybill::class),
            Text::make(__('Order No'), 'order_no')->maxlength(100)->copyable(),
            Text::make(__('Site'), 'site')->maxlength(100),
            Text::make(__('Master Goods Cd'), 'master_goods_cd')->maxlength(100)->copyable(),
            Text::make(__('Goods Nm'), 'goods_nm')->maxlength(255),
            Text::make(__('Option'), 'option')->maxlength(255),
            KeyValue::make(__('Json'), 'json'),
            Status::make(__('Status'), 'status')
                ->default(MismatchedStatus::READY->name)
                ->loadingWhen(MismatchedStatus::loadingWhen())
                ->failedWhen(MismatchedStatus::failedWhen())
                ->filterable(function ($request, $query, $value, $attribute) {
                    $query->where($attribute, $value);
                })->displayUsing(function ($value) {
                    return MismatchedStatus::{$value}->value() ?? '-';
                }),
            BelongsTo::make(__('Author'), 'author', User::class),
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
            (new ChangeStatusAction(MismatchedStatus::COMPLETED))->showInline(),
        ];
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
