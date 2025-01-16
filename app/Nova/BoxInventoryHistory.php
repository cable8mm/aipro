<?php

namespace App\Nova;

use App\Enums\InventoryHistory;
use App\Enums\InventoryHistoryModel;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class BoxInventoryHistory extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\BoxInventoryHistory>
     */
    public static $model = \App\Models\BoxInventoryHistory::class;

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
            BelongsTo::make(__('Box'), 'box', Box::class),
            Select::make(__('Type'), 'type')->options(InventoryHistory::array())->displayUsingLabels()
                ->rules('required')->required(),
            Select::make(__('Model'), 'model')->options(InventoryHistoryModel::array())->displayUsingLabels()->rules('required')->required(),
            Text::make(__('Attribute'), 'attribute')->rules('required', 'gt:0')->required(),
            Number::make(__('Quantity'), 'quantity')->rules('required')->required()->displayUsing(function ($value) {
                return number_format($value);
            }),
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
        return __('Box Inventory History');
    }
}
