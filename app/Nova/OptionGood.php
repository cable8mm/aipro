<?php

namespace App\Nova;

use App\Enums\UserType;
use App\Traits\NovaAuthorizedByMd;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class OptionGood extends Resource
{
    use NovaAuthorizedByMd;

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
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
            Text::make(__('Master Code'), 'master_code')
                ->rules('required')->required()
                ->copyable()
                ->maxlength(130),
            Text::make(__('Name'), 'name')->rules('required')->required()->maxlength(130),
            Number::make(__('Option Count'), 'option_count')->exceptOnForms(),
            Boolean::make(__('Is Active'), 'is_active'),
            DateTime::make(__('Created At'), 'created_at')->exceptOnForms(),
            DateTime::make(__('Updated At'), 'updated_at')->exceptOnForms(),

            HasMany::make(__('Option Good Options'), 'optionGoodOptions', OptionGoodOption::class),

            MorphOne::make('PromotionCode'),
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
        return __('Option Goods');
    }

    public function title()
    {
        return '['.$this->master_code.'] '.$this->name;
    }

    public function authorizedToUpdate(Request $request)
    {
        return $request->user()?->type == UserType::ADMINISTRATOR->name
            || $request->user()?->type == UserType::DEVELOPER->name
            || $request->user()?->type == UserType::MANAGER->name
            || $request->user()?->id == $this->user_id;
    }
}
