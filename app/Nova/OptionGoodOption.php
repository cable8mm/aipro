<?php

namespace App\Nova;

use App\Enums\UserType;
use App\Traits\NovaAuthorizedByMd;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Outl1ne\NovaSortable\Traits\HasSortableRows;

class OptionGoodOption extends Resource
{
    use HasSortableRows, NovaAuthorizedByMd;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\OptionGoodOption>
     */
    public static $model = \App\Models\OptionGoodOption::class;

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
        'name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make(),

            BelongsTo::make(__('Author'), 'author', User::class)->exceptOnForms(),

            BelongsTo::make(__('Option Good'), 'optionGood', OptionGood::class),

            Text::make(__('Name'), 'name')->rules('required')->required()
                ->help(__('The option must match this field, so please enter the exact name.')),

            Text::make(__('Goods Code'), function () {
                return $this->optionable->goods_code;
            }),

            MorphTo::make(__('Option Good Optionable'), 'optionable')
                ->types([
                    Good::class,
                    SetGood::class,
                ]),

            Number::make(__('Sort Order'), 'sort_order')->exceptOnForms(),

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
        return __('Option Good Option');
    }

    public function title()
    {
        return '['.$this->name.'] '.$this->optionGood->title;
    }

    public function authorizedToUpdate(Request $request)
    {
        return $request->user()?->type == UserType::ADMINISTRATOR
            || $request->user()?->type == UserType::DEVELOPER
            || $request->user()?->type == UserType::MANAGER
            || $request->user()?->id == $this->user_id;
    }
}
