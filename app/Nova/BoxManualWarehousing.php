<?php

namespace App\Nova;

use App\Enums\ManualInventoryAdjustmentType;
use App\Traits\NovaAuthorizedByWarehouser;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class BoxManualWarehousing extends Resource
{
    use NovaAuthorizedByWarehouser;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\BoxManualWarehousing>
     */
    public static $model = \App\Models\BoxManualWarehousing::class;

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
        'Box.name',
        'Box.code',
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
            BelongsTo::make(__('Author'), 'author', User::class)->exceptOnForms(),
            BelongsTo::make(__('Box'), 'box', Box::class),
            Select::make(__('Type'), 'type')
                ->rules('required')->required()
                ->options(ManualInventoryAdjustmentType::array())
                ->displayUsingLabels()
                ->filterable()
                ->hideFromIndex(),
            Badge::make(__('Type'), 'type')
                ->map(ManualInventoryAdjustmentType::array(value: 'success'))
                ->labels(ManualInventoryAdjustmentType::array())
                ->onlyOnIndex(),
            Number::make(__('Manual Add Inventory Count'), 'manual_add_inventory_count')
                ->rules('required', 'notIn:0')->displayUsing(function ($value) {
                    return number_format($value);
                })->default(0),
            Text::make(__('Memo'), 'memo'),
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
        return __('Box Manual Warehousings');
    }

    public function authorizedToView(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }
}
