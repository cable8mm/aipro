<?php

namespace App\Nova;

use App\Enums\ManualInventoryAdjustmentType;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class GoodManualWarehousing extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\GoodManualWarehousing>
     */
    public static $model = \App\Models\GoodManualWarehousing::class;

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
        'Good.name',
        'Good.master_code',
        'memo',
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
            Text::make(__('마스터 코드'), 'Good.master_code')->onlyOnIndex(),
            Text::make(__('공급사'), 'Good.supplier.name')->onlyOnIndex(),
            BelongsTo::make(__('Good'), 'good', Good::class),
            BelongsTo::make(__('User'), 'user', User::class),
            Select::make(__('Type'), 'type')->options(ManualInventoryAdjustmentType::array())->displayUsingLabels()->filterable(),
            Number::make(__('Manual Add Inventory Count'), 'manual_add_inventory_count')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Text::make(__('Memo'), 'memo')->nullable(),
            DateTime::make(__('Created At'), 'created_at')->onlyOnIndex()->filterable(),
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
        return __('Good Manual Warehousings');
    }
}
