<?php

namespace App\Nova;

use App\Enums\Status as EnumsStatus;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class PlacingOrder extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PlacingOrder>
     */
    public static $model = \App\Models\PlacingOrder::class;

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
            Hidden::make('User', 'user_id')->default(function ($request) {
                return $request->user()->id;
            }),
            BelongsTo::make('Warehouse Manager', 'warehouseManager', User::class),
            BelongsTo::make('Supplier'),
            Text::make('Title')->required()->rules('required')->maxlength(190),
            Number::make('Total Good Count')->exceptOnForms()->displayUsing(function ($value) {
                return number_format($value);
            }),
            Currency::make('Total Order Price')->exceptOnForms(),
            Number::make('Order Discount Percent')->min(1)->max(100)->step(1)
                ->displayUsing(fn () => "{$this->order_discount_percent}%")
                ->exceptOnForms(),
            DateTime::make('Ordered At')->nullable()
                ->displayUsing(fn ($value) => $value ? $value->format('Y-m-d H, g:ia') : ''),
            DateTime::make('Predict Warehoused At')->nullable(),
            DateTime::make('Sent At')->exceptOnForms(),
            DateTime::make('Confirmed At')->exceptOnForms(),
            DateTime::make('Warehoused At')->exceptOnForms(),
            Status::make('Status')
                ->loadingWhen(EnumsStatus::loadingWhen())
                ->failedWhen(EnumsStatus::failedWhen()),
            Textarea::make('Memo')->alwaysShow(),

            HasMany::make('Placing Order Goods', 'placingOrderGoods', PlacingOrderGood::class),
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
}
