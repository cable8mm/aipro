<?php

namespace App\Nova;

use App\Enums\Status as EnumsStatus;
use App\Traits\NovaAuthorizedByNotReviewer;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class RegisterGoodRequest extends Resource
{
    use NovaAuthorizedByNotReviewer;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\RegisterGoodRequest>
     */
    public static $model = \App\Models\RegisterGoodRequest::class;

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
        'author.name',
        'worker.name',
        'title',
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
            BelongsTo::make(__('Worker'), 'worker', User::class),
            Text::make(__('Title'), 'title')->rules('required')->required()->maxlength(255),
            File::make(__('Request File Url'), 'request_file_url'),
            File::make(__('Respond File Url'), 'respond_file_url'),
            Boolean::make(__('Has Supplier Monitoring Price'), 'has_supplier_monitoring_price')->default(false),
            Status::make(__('Status'), 'status')
                ->loadingWhen(EnumsStatus::loadingWhen())
                ->failedWhen(EnumsStatus::failedWhen())
                ->filterable(function ($request, $query, $value, $attribute) {
                    $query->where($attribute, $value);
                })->displayUsing(function ($value) {
                    return EnumsStatus::{$value}->value() ?? '-';
                }),
            Textarea::make(__('Memo'), 'memo')->alwaysShow(),
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
        return __('Register Good Requests');
    }
}
