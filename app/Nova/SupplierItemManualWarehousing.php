<?php

namespace App\Nova;

use App\Traits\NovaAuthorizedByWarehouser;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SupplierItemManualWarehousing extends Resource
{
    use NovaAuthorizedByWarehouser;

    public static $globallySearchable = false;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\SupplierItemManualWarehousing>
     */
    public static $model = \App\Models\SupplierItemManualWarehousing::class;

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
            BelongsTo::make(__('Author'), 'author', SupplierItem::class)->exceptOnForms(),
            BelongsTo::make(__('Supplier Good'), 'supplierGood', SupplierItem::class)->searchable(),
            Number::make(__('Manual Add Inventory Count'), 'manual_add_inventory_count')
                ->rules('required', 'integer')->required(),
            Text::make(__('Memo'), 'memo')->maxlength(255)
                ->rules('required', 'integer')->required(),
            DateTime::make(__('Created At'), 'created_at')->exceptOnForms(),
            DateTime::make(__('Updated At'), 'updated_at')->exceptOnForms(),
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
        return __('Supplier Good Manual Warehousings');
    }

    public function title()
    {
        return __('Supplier Good Manual Warehousing').' '.'#'.$this->id;
    }

    public function authorizedToView(Request $request)
    {
        return false;
    }
}
