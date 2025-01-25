<?php

namespace App\Nova;

use App\Enums\UserType;
use App\Traits\NovaAuthorizedByManager;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class ShutdownGood extends Resource
{
    use NovaAuthorizedByManager;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ShutdownGood>
     */
    public static $model = \App\Models\ShutdownGood::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title',
        'master_code',
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
            Text::make(__('Master Code'), 'master_code')->rules('required')->required()->maxlength(150)->copyable(),
            Text::make(__('Title'), 'title')->rules('required')->required()->maxlength(255),
            Textarea::make(__('Reason'), 'reason')->rules('required')->required()->alwaysShow(),
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
        return __('Shutdown Goods');
    }

    public function authorizedToUpdate(Request $request)
    {
        return $request->user()?->type == UserType::ADMINISTRATOR->name
            || $request->user()?->type == UserType::DEVELOPER->name
            || $request->user()?->type == UserType::MANAGER->name
            || $request->user()?->id == $this->author_id;
    }
}
