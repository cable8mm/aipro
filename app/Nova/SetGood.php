<?php

namespace App\Nova;

use App\Nova\Actions\ToggleIsActive;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class SetGood extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\SetGood>
     */
    public static $model = \App\Models\SetGood::class;

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
        'goods_code',
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
            ID::make()->sortable(),

            BelongsTo::make(__('Author'), 'author', User::class)
                ->exceptOnForms()
                ->filterable(),

            Text::make(__('Shortening Goods Code'), fn () => 'COM'.$this->id)
                ->copyable()
                ->exceptOnForms(),

            Text::make(__('Goods Code'), 'goods_code')
                ->maxlength(255)
                ->copyable()
                ->readonly()
                ->help(__('This value can only input by adding or updating related goods')),

            Number::make(__('Good Count'), 'good_count')->exceptOnForms(),

            Text::make(__('Name'), 'name')->rules('required')->required()->maxlength(255),

            Currency::make(__('Goods Price'), 'goods_price')->rules('required')->required(),

            Currency::make(__('Last Cost Price'), 'last_cost_price')->exceptOnForms(),

            Currency::make(__('Zero Margin Price'), 'zero_margin_price')->exceptOnForms(),

            Boolean::make(__('Is Active'), 'is_active'),

            Stack::make(__('Created At').' & '.__('Updated At'), [
                DateTime::make(__('Created At'), 'created_at'),
                DateTime::make(__('Updated At'), 'updated_at'),
            ]),

            BelongsToMany::make(__('Goods'), 'goods', Good::class)
                ->searchable()
                ->fields(
                    function ($request, $relatedModel) {
                        return [
                            Number::make(__('Quantity'), 'quantity')->rules('required')->required()->default(1),
                        ];
                    }
                ),
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
        return [
            (new ToggleIsActive(true))->showInline(),
            (new ToggleIsActive(false))->showInline(),
        ];
    }

    public static function label()
    {
        return __('Set Goods');
    }

    public function title()
    {
        return '['.$this->goods_code.'] '.$this->name;
    }
}
