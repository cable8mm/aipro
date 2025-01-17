<?php

namespace App\Nova;

use App\Enums\InventoryHistory as EnumsInventoryHistory;
use App\Enums\InventoryHistoryModel;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Http\Requests\NovaRequest;

class InventoryHistory extends Resource
{
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
            BelongsTo::make(__('User'), 'user', User::class),
            BelongsTo::make(__('Good'), 'good', Good::class),
            Select::make(__('Type'), 'type')->options(EnumsInventoryHistory::array())
                ->rules('required')->required()->displayUsingLabels(),
            Number::make(__('Quantity'), 'quantity')->displayUsing(function ($value) {
                return number_format($value);
            })->rules('required')->required(),
            Currency::make(__('Price'), 'price')->rules('required')->required(),
            Number::make(__('After Quantity'), 'after_quantity')->displayUsing(function ($value) {
                return number_format($value);
            })->rules('required')->required(),
            Select::make(__('Model'), 'model')->options(InventoryHistoryModel::array())
                ->rules('required')->required()->displayUsingLabels(),
            Number::make(__('Attribute'), 'attribute')->rules('required')->required(),
            Number::make(__('Cancel Id'), 'cancel_id'),
            Boolean::make(__('Is Success'), 'is_success')->rules('required')->required(),
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
        return __('Inventory History');
    }

    public function title()
    {
        return __('Inventory History').' #'.$this->id;
    }
}
