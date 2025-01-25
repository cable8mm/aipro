<?php

namespace App\Nova;

use App\Enums\UserType;
use App\Traits\NovaAuthorizedByMd;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class OptionGoodOption extends Resource
{
    use NovaAuthorizedByMd;

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
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'master_code',
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
            BelongsTo::make(__('Author'), 'author', User::class),
            BelongsTo::make(__('Option Good'), 'optionGood', OptionGood::class),
            Text::make(__('Master Code'), 'master_code')
                ->rules('required')->required()
                ->copyable()
                ->maxlength(130),
            Text::make(__('Name'), 'name')->rules('required')->required()->maxlength(130),
            Currency::make(__('Goods Price'), 'goods_price'),
            Currency::make(__('Last Cost Price'), 'last_cost_price'),
            Currency::make(__('Zero Margin Price'), 'zero_margin_price'),
            Number::make('순서', 'order'),
            Boolean::make(__('Is My Shop Sale'), 'is_my_shop_sale'),
            Boolean::make(__('Is Other Shop Sale'), 'is_other_shop_sale'),
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
