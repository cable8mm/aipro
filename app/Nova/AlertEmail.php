<?php

namespace App\Nova;

use App\Traits\NovaAuthorizedByManager;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Tag;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class AlertEmail extends Resource
{
    use NovaAuthorizedByManager;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\AlertEmail>
     */
    public static $model = \App\Models\AlertEmail::class;

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
        'name',
        'action_name',
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
            Text::make(__('Name'), 'name')->rules('required')->required()->maxlength(255),
            Text::make(__('Action Name'), 'action_name')->rules('required')->required()->maxlength(255)->copyable(),

            Tag::make(__('Users'), 'users', User::class)->preload()->withPreview(),

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
        return __('Alert Email');
    }
}
