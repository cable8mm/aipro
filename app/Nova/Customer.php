<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Customer extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Customer>
     */
    public static $model = \App\Models\Customer::class;

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
        'name',
        'contact_name',
        'contact_tel',
        'contact_cel',
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
            Text::make(__('Name'), 'name')->maxlength(50)->rules('required')->required(),
            Text::make(__('Contact Name'), 'contact_name')->maxlength(50)->rules('required')->required(),
            Text::make(__('Contact Cel'), 'contact_cel')->maxlength(40)->rules('required')->required(),
            Text::make(__('Contact Tel'), 'contact_tel')->maxlength(40),
            Text::make(__('Balance Criteria'), 'balance_criteria')->maxlength(100),
            Trix::make(__('Additional Information'), 'additional_information')
                ->alwaysShow()->nullable(),
            Boolean::make(__('Is Active'), 'is_active')->default(true)->filterable(),
            Stack::make(__('Created At').' & '.__('Updated At'), [
                DateTime::make(__('Created At'), 'created_at'),
                DateTime::make(__('Updated At'), 'updated_at'),
            ])->hideFromIndex(),

            HasMany::make(__('Retail Purchases'), 'retailPurchases', RetailPurchase::class),
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
        return __('Customers');
    }

    public function title()
    {
        return '['.$this->name.'] '.$this->contact_name;
    }
}
