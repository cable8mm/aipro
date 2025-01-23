<?php

namespace App\Nova;

use App\Enums\PlacingOrder;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class BoxOrderBox extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\BoxOrderBox>
     */
    public static $model = \App\Models\BoxOrderBox::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'Box Order Boxes';

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
            BelongsTo::make(__('Box Order'), 'boxOrder', BoxOrder::class),
            BelongsTo::make(__('Author'), 'author', User::class),
            BelongsTo::make(__('Box Supplier'), 'boxSupplier', BoxSupplier::class),
            BelongsTo::make(__('Box'), 'box', Box::class),
            BelongsTo::make(__('Warehouse Manager'), 'warehouseManager', User::class),
            Number::make(__('Order Count'), 'order_count'),
            Currency::make(__('Order Price'), 'order_price'),
            Number::make(__('Cost Count'), 'cost_count'),
            Currency::make(__('Cost Price'), 'cost_price'),
            DateTime::make(__('Warehoused At'), 'warehoused_at'),
            Select::make(__('Status'), 'status')
                ->options(PlacingOrder::array())->displayUsingLabels()->filterable(),
            Textarea::make(__('Memo')),
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
}
