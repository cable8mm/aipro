<?php

namespace App\Nova\Repeater;

use App\Nova\Good;
use App\Nova\OptionGood;
use App\Nova\SetGood;
use App\Nova\User;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Repeater\Repeatable;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class OptionGoodOption extends Repeatable
{
    /**
     * The underlying model the repeatable represents.
     *
     * @var class-string
     */
    public static $model = \App\Models\OptionGoodOption::class;

    /**
     * Get the fields displayed by the repeatable.
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
            MorphTo::make(__('Option Good Optionable'), 'optionGoodOptionable')
                ->types([
                    Good::class,
                    SetGood::class,
                ]),
            Number::make(__('Sort Order'), 'sort_order')->exceptOnForms(),
        ];
    }
}
