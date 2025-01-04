<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class ChannelGood extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ChannelGood>
     */
    public static $model = \App\Models\ChannelGood::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'Channel Goods';

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
            Text::make('Playauto Master Code')->maxlength(65535),
            Text::make('Goods Bar')->maxlength(65535),
            Number::make('Coupang Price'),
            Text::make('Coupang Sale Status')->maxlength(65535),
            Text::make('Coupang Approved')->maxlength(65535),
            Number::make('Coupang Inventory'),
            Number::make('Kakaotalk Price'),
            Text::make('Kakaotalk Sale Status')->maxlength(65535),
            Number::make('Kakaotalk Inventory'),
            Number::make('Ssg Price'),
            Text::make('Ssg Sale Status')->maxlength(65535),
            Number::make('Ssg Inventory'),
            Number::make('11st Price'),
            Text::make('11st Sale Status')->maxlength(65535),
            Number::make('11st Inventory'),
            Number::make('Gmarket Price'),
            Text::make('Gmarket Sale Status')->maxlength(65535),
            Number::make('Gmarket Inventory'),
            Text::make('Storefarm Channel')->maxlength(65535),
            Number::make('Storefarm Price'),
            Text::make('Storefarm Sale Status')->maxlength(65535),
            Number::make('Storefarm Inventory'),
            Number::make('Auction Price'),
            Text::make('Auction Sale Status')->maxlength(65535),
            Number::make('Auction Inventory'),
            Number::make('Wemake Price'),
            Text::make('Wemake Sale Status')->maxlength(65535),
            Number::make('Gift Price'),
            Text::make('Gift Sale Status')->maxlength(65535),
            Number::make('Gift Inventory'),
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
