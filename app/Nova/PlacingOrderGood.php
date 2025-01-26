<?php

namespace App\Nova;

use App\Enums\CenterClass;
use App\Enums\PlacingOrderGoodStatus;
use App\Enums\SafeClass;
use App\Traits\NovaAuthorizedByWarehouser;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class PlacingOrderGood extends Resource
{
    use NovaAuthorizedByWarehouser;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PlacingOrderGood>
     */
    public static $model = \App\Models\PlacingOrderGood::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'good_id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'Good.master_code',
        'Good.name',
        'Good.supplier.name',
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
            BelongsTo::make(__('Placing Order'), 'placingOrder', PlacingOrder::class),
            BelongsTo::make(__('Author'), 'author', User::class)->exceptOnForms(),
            BelongsTo::make(__('Warehouse Manager'), 'warehouseManager', User::class),
            Text::make(__('Master Code'), 'Good.master_code')->exceptOnForms(),
            Text::make(__('Safe Class'), 'Good.safe_class')->exceptOnForms()
                ->displayUsing(function ($value) {
                    return SafeClass::{$value}->value();
                }),
            Text::make(__('Center Class'), 'Good.center_class')->exceptOnForms()
                ->displayUsing(function ($value) {
                    return CenterClass::{$value}->value();
                }),
            Text::make(__('Supplier'), 'Good.supplier.name')->exceptOnForms(),
            BelongsTo::make(__('Good'), 'good', Good::class)->searchable(),
            Number::make(__('Order Count'), 'order_count')->rules('required')->required()->displayUsing(function ($value) {
                return number_format($value);
            }),
            Currency::make(__('Order Price'), 'order_price')->rules('required')->required(),
            Number::make(__('Supplier Confirmed Count'), 'supplier_confirmed_count')->displayUsing(function ($value) {
                return number_format($value);
            })->exceptOnForms()->hideFromIndex(),
            Currency::make(__('Supplier Confirmed Price'), 'supplier_confirmed_price')->exceptOnForms()->hideFromIndex(),
            Number::make(__('Cost Count'), 'cost_count')->rules('required')->required()->displayUsing(function ($value) {
                return number_format($value);
            }),
            Currency::make(__('Cost Price'), 'cost_price'),
            Currency::make(__('Unit Price'), function () {
                return (int) round($this->cost_price / $this->cost_count);
            }),
            Boolean::make(__('Is Promotion'), 'is_promotion'),
            DateTime::make(__('Warehoused At'), 'warehoused_at')->filterable(),
            Status::make(__('Status'), 'status')
                ->loadingWhen(PlacingOrderGoodStatus::loadingWhen())
                ->failedWhen(PlacingOrderGoodStatus::failedWhen())
                ->filterable(function ($request, $query, $value, $attribute) {
                    $query->where($attribute, $value);
                })->displayUsing(function ($value) {
                    return PlacingOrderGoodStatus::{$value}->value() ?? '-';
                }),
            Textarea::make(__('Memo'), 'memo')->alwaysShow(),
            Stack::make(__('Created At').' & '.__('Updated At'), [
                DateTime::make(__('Created At'), 'created_at'),
                DateTime::make(__('Updated At'), 'updated_at'),
            ])->hideFromIndex(),
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
        return __('Placing Order Good');
    }

    public function title()
    {
        return '['.$this->good->master_code.'] '.$this->good->name;
    }
}
