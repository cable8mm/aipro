<?php

namespace App\Nova\Repeaters;

use App\Models\Good as ModelsGood;
use App\Models\SetGood as ModelsSetGood;
use App\Nova\Good;
use App\Nova\SetGood;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Repeater\Repeatable;
use Laravel\Nova\Fields\Select;
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

            Text::make(__('Name'), 'name')->rules('required')->required()
                ->help(__('The option must match this field, so please enter the exact name.')),

            Select::make(__('Option Good Optionable Type'), 'optionable_type')
                ->rules('required')->required()
                ->options([
                    ModelsGood::class => __('Good'),
                    ModelsSetGood::class => __('Set Good'),
                ]),

            Number::make(__('Option Good Optionable Id'), 'optionable_id')
                ->rules('required')->required(),

            // MorphTo::make(__('Option Good Optionable'), 'optionable')
            //     ->types([
            //         Good::class,
            //         SetGood::class,
            //     ]),
            // Number::make(__('Sort Order'), 'sort_order')->exceptOnForms(),
        ];
    }
}
