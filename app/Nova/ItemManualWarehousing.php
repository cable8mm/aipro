<?php

namespace App\Nova;

use App\Enums\ItemManualWarehousingType;
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

class ItemManualWarehousing extends Resource
{
    use NovaAuthorizedByWarehouser;

    public static $globallySearchable = false;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ItemManualWarehousing>
     */
    public static $model = \App\Models\ItemManualWarehousing::class;

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
        'Item.name',
        'Item.sku',
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

            Text::make(__('SKU'), 'Item.sku')->onlyOnIndex(),

            Text::make(__('Supplier Name'), 'Item.supplier.name')->onlyOnIndex(),

            BelongsTo::make(__('Item'), 'item', Item::class)
                ->searchable()
                ->help(__('You can search for items by sku, item name or supplier name.')),

            Select::make(__('Type'), 'type')
                ->rules('required')->required()
                ->options(ItemManualWarehousingType::array())
                ->displayUsingLabels()
                ->filterable()
                ->hideFromIndex(),

            Badge::make(__('Type'), 'type')
                ->map(ItemManualWarehousingType::array(value: 'success'))
                ->labels(ItemManualWarehousingType::array())
                ->onlyOnIndex(),

            Number::make(__('Amount'), 'amount')
                ->rules('required', 'notIn:0')->required()
                ->default(-1)
                ->displayUsing(function ($value) {
                    return number_format($value);
                }),

            Text::make(__('Memo'), 'memo')->nullable(),

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
        return __('Item Manual Warehousings');
    }

    public function title()
    {
        return $this->type->value().' '.'#'.$this->id;
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
