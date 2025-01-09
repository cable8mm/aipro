<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class OptionGoodOption extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\OptionGoodOption>
     */
    public static $model = \App\Models\OptionGoodOption::class;

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
            BelongsTo::make(__('Option Good'), 'optionGood', OptionGood::class),
            Text::make(__('Master Code'), 'master_code')->maxlength(130),
            Text::make(__('Name'), 'name')->maxlength(130),
            Currency::make(__('Goods Price'), 'goods_price'),
            Currency::make(__('Last Cost Price'), 'last_cost_price'),
            Currency::make(__('Zero Margin Price'), 'zero_margin_price'),
            Number::make(__('Order'), 'order'),
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
        return __('Option Good Option');
    }
}
