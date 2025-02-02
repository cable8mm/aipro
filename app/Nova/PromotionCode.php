<?php

namespace App\Nova;

use App\Enums\UserType;
use App\Traits\NovaAuthorizedByMd;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class PromotionCode extends Resource
{
    use NovaAuthorizedByMd;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PromotionCode>
     */
    public static $model = \App\Models\PromotionCode::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'master_code';

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
            MorphTo::make(__('Promotion Codable'), 'promotionCodable')
                ->types([
                    Good::class,
                    SetGood::class,
                ]),
            Text::make(__('Master Code'), 'master_code')
                ->rules('required')->required()
                ->copyable()
                ->exceptOnForms()
                ->maxlength(100),
            Text::make(__('Memo'), 'memo')->rules('required')->required()->maxlength(255),
            DateTime::make(__('Started At'), 'started_at')->nullable(),
            DateTime::make(__('Finished At'), 'finished_at')->nullable(),
            Textarea::make(__('Memo'), 'memo')->maxlength(190)->alwaysShow(),
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
        return __('Promotion Codes');
    }

    public function authorizedToUpdate(Request $request)
    {
        return $request->user()?->type == UserType::ADMINISTRATOR->name
            || $request->user()?->type == UserType::DEVELOPER->name
            || $request->user()?->type == UserType::MANAGER->name
            || $request->user()?->id == $this->user_id;
    }
}
