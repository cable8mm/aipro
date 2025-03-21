<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class HelpfulFile extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\HelpfulFile>
     */
    public static $model = \App\Models\HelpfulFile::class;

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

            BelongsTo::make(__('Author'), 'author', User::class)->exceptOnForms(),

            File::make(__('Attachment'), 'attachment')->required()
                ->disk('builtin')
                ->path('helpful_files')
                ->creationRules('required', 'file')
                ->updateRules('nullable', 'file'),

            Text::make(__('Description'), 'description')->rules('required')->required(),

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
        return __('Helpful Files');
    }

    public function title()
    {
        return __('Helpful Files').' '.'#'.$this->id;
    }
}
