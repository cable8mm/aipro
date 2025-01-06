<?php

namespace App\Nova;

use Laravel\Nova\Fields\Boolean;
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
    public static $title = 'Option Good Options';

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
            Number::make('Cms Maestro Id'),
            Number::make('Ct Option Good Id'),
            Text::make('Playauto Master Code')->maxlength(130),
            Text::make('Name')->maxlength(130),
            Number::make('Goods Price'),
            Number::make('Last Cost Price'),
            Number::make('Zero Margin Price'),
            Number::make('Suggested Selling Price Of Gms'),
            Number::make('Order'),
            Text::make('Goods Bar')->maxlength(190),
            Boolean::make('Is My Shop Sale'),
            Boolean::make('Is Other Shop Sale'),
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
