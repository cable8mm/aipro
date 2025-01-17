<?php

namespace App\Nova;

use App\Enums\PlacingOrder as EnumsPlacingOrder;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
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
            BelongsTo::make(__('Warehouse Manager'), 'warehouseManager', User::class),
            BelongsTo::make(__('Supplier'), 'supplier', Supplier::class)->filterable(),
            Text::make(__('Title'), 'title')->required()->rules('required')->maxlength(190),
            Number::make(__('Total Good Count'), 'total_good_count')->exceptOnForms()->displayUsing(function ($value) {
                return number_format($value);
            }),
            Currency::make(__('Total Order Price'), 'total_order_price')->exceptOnForms(),
            Number::make(__('Order Discount Percent'), 'order_discount_percent')->min(1)->max(100)->step(1)
                ->displayUsing(fn () => "{$this->order_discount_percent}%")
                ->exceptOnForms(),
            DateTime::make(__('Ordered At'), 'ordered_at')->nullable()
                ->displayUsing(fn ($value) => $value ? $value->format('Y-m-d H, g:ia') : '')->filterable(),
            DateTime::make(__('Predict Warehoused At'), 'predict_warehoused_at')->nullable()->filterable(),
            DateTime::make(__('Sent At'), 'sent_at')->exceptOnForms(),
            DateTime::make(__('Confirmed At'), 'confirmed_at')->exceptOnForms(),
            DateTime::make(__('Warehoused At'), 'warehoused_at')->exceptOnForms(),
            Textarea::make(__('Memo'), 'memo')->alwaysShow(),
            Select::make(__('Status'), 'status')
                ->options(EnumsPlacingOrder::array())->displayUsingLabels()->filterable(),
            Stack::make(__('Created At').' & '.__('Updated At'), [
                DateTime::make(__('Created At'), 'created_at'),
                DateTime::make(__('Updated At'), 'updated_at'),
            ]),

            HasMany::make(__('Placing Order Goods'), 'placingOrderGoods', PlacingOrderGood::class),
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
        return [
            new Filters\PlacingOrderFinished,
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
        return __('Placing Order');
    }

    public function title()
    {
        return __('Placing Order').' '.'#'.$this->id;
    }
}
