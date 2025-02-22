<?php

namespace App\Nova;

use App\Nova\Metrics\BoxSumCostPrice;
use App\Nova\Metrics\BoxSumInventory;
use App\Traits\NovaAuthorizedByManager;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Box extends Resource
{
    use NovaAuthorizedByManager;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Box>
     */
    public static $model = \App\Models\Box::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'code',
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
            Text::make(__('Code'), 'code')->maxlength(50),
            Text::make(__('Name'), 'name')->maxlength(100)->sortable(),
            Currency::make(__('Delivery Price'), 'delivery_price'),
            Currency::make(__('Cost Price'), 'cost_price'),
            Number::make(__('Inventory'), 'inventory')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Textarea::make(__('Memo'), 'memo')->maxlength(255)->alwaysShow(),
            DateTime::make(__('Created At'), 'created_at')->exceptOnForms(),
            DateTime::make(__('Updated At'), 'updated_at')->exceptOnForms(),

            HasMany::make(__('Box Purchase Order Items'), 'boxPurchaseOrderItems', BoxPurchaseOrderItem::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            new BoxSumCostPrice,
            new BoxSumInventory,
        ];
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
        return __('Box');
    }
}
