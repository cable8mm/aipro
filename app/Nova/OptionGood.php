<?php

namespace App\Nova;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class OptionGood extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\OptionGood>
     */
    public static $model = \App\Models\OptionGood::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'Option Goods';

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
            Text::make('Name')->maxlength(65535),
            Number::make('Option Count'),
            Number::make('My Shop Sale Option Count'),
            Number::make('Other Shop Sale Option Count'),
            Boolean::make('Is Active'),
            DateTime::make('Created At'),
            DateTime::make('Updated At'),
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
