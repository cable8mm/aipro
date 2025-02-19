<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class Good extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Good>
     */
    public static $model = \App\Models\Good::class;

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
            BelongsTo::make(__('Item'), 'item', Item::class),
            Text::make(__('Goods Code'), 'goods_code')
                ->rules('required')->required()->maxlength(255)
                ->sortable(),
            Text::make(__('Name'), 'name')
                ->rules('required')->required()->maxlength(255)->onlyOnForms(),
            Text::make(__('Option'), 'option'),
            Panel::make(__('Additional Information'), [
                Currency::make(__('Supplier monitoring Price'), 'supplier_monitoring_price'),
                Text::make(__('Supplier monitoring Status'), 'supplier_monitoring_status'),
                Boolean::make(__('Supplier monitoring Interruption'), 'supplier_monitoring_interruption'),
                Currency::make(__('Goods Price'), 'goods_price'),
                Textarea::make(__('Memo'), 'memo')->alwaysShow(),
                Number::make(__('Naver Category'), 'naver_category'),
                Number::make(__('Naver Productid'), 'naver_productid'),
                Boolean::make(__('Naver Lowest Price Wrong'), 'naver_lowest_price_wrong'),
                Currency::make(__('Naver Lowest Price'), 'naver_lowest_price'),
                Currency::make(__('Internet Lowest Price'), 'internet_lowest_price'),
                Currency::make(__('Zero Margin Price'), 'zero_margin_price'),
            ])->withToolbar()->limit(3),

            Stack::make(__('Created At').' & '.__('Updated At'), [
                DateTime::make(__('Created At'), 'created_at'),
                DateTime::make(__('Updated At'), 'updated_at'),
            ])->hideFromIndex(),
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
        return __('Good');
    }

    public function title()
    {
        return '['.$this->goods_code.'] '.$this->name;
    }
}
