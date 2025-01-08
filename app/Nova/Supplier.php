<?php

namespace App\Nova;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Supplier extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Supplier>
     */
    public static $model = \App\Models\Supplier::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

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
            Text::make('Name')->maxlength(255),
            Email::make('Ordered Email', 'ordered_email')->maxlength(255),
            Text::make('Contact Name')->maxlength(255),
            Text::make('Contact Tel')->maxlength(255),
            Text::make('Contact Cel')->maxlength(255),
            Select::make('Order Method', 'order_method')->options([
                'sms' => '문자 메시지',
                'email' => '이메일',
                'phone' => '전화',
                'kakaotalk' => '카카오톡',
                'order_system' => '발주 시스템',
            ])->displayUsingLabels(),
            Currency::make('Min Order Price'),
            Textarea::make('Additional Information')->alwaysShow(),
            Boolean::make('Is Active')->default(true),

            HasMany::make('Supplier Goods'),
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
