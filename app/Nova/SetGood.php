<?php

namespace App\Nova;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SetGood extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\SetGood>
     */
    public static $model = \App\Models\SetGood::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'Set Goods';

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
            Text::make('Playauto Master Code')->maxlength(65535),
            Text::make('Godo Code')->maxlength(65535),
            Text::make('Featured Good List')->maxlength(65535),
            Text::make('Name')->maxlength(65535),
            Number::make('Goods Price'),
            Number::make('Last Cost Price'),
            Number::make('Zero Margin Price'),
            Number::make('Suggested Selling Price Of Gms'),
            Boolean::make('Is Gift'),
            Boolean::make('Is Shutdowned'),
            Text::make('Goods Bar')->maxlength(65535),
            Boolean::make('Is My Shop Sale'),
            Boolean::make('Is Other Shop Sale'),
            DateTime::make('Created'),
            DateTime::make('Modified'),
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
