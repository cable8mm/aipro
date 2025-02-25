<?php

namespace App\Nova;

use App\Enums\ItemInventoryLevel;
use App\Enums\UserType;
use App\Traits\NovaAuthorizedByDeveloper;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class ItemInventorySnapshot extends Resource
{
    use NovaAuthorizedByDeveloper;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ItemInventorySnapshot>
     */
    public static $model = \App\Models\ItemInventorySnapshot::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'playauto_sku';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'playauto_sku',
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
            BelongsTo::make(__('Author'), 'author', User::class),
            BelongsTo::make(__('Item'), 'item', Item::class),
            Text::make(__('Playauto SKU'), 'playauto_sku')->maxlength(50),
            Number::make(__('Inventory'), 'inventory'),
            Select::make(__('Inventory Level'), 'inventory_level')->options(ItemInventoryLevel::array())->displayUsingLabels(),
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
        return __('Item Inventory Snapshots');
    }

    public function title()
    {
        return __('Item Inventory Snapshots').' #'.$this->id;
    }

    public function authorizedToView(Request $request)
    {
        return $request->user()?->type == UserType::ADMINISTRATOR->name
            || $request->user()?->type == UserType::DEVELOPER->name
            || $request->user()?->id == $this->author_id;
    }

    public function authorizedToUpdate(Request $request)
    {
        return $request->user()?->type == UserType::ADMINISTRATOR->name
            || $request->user()?->type == UserType::DEVELOPER->name
            || $request->user()?->id == $this->author_id;
    }
}
