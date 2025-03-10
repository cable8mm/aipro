<?php

namespace App\Nova;

use App\Enums\OrderMethod;
use App\Traits\NovaAuthorizedByWarehouser;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class BoxSupplier extends Resource
{
    use NovaAuthorizedByWarehouser;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\BoxSupplier>
     */
    public static $model = \App\Models\BoxSupplier::class;

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
        'ordered_email',
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

            Text::make(__('Name'), 'name')->maxlength(255)
                ->rules('required')->required(),

            Text::make(__('Ordered Email'), 'ordered_email')->maxlength(255),

            Text::make(__('Contact Name'), 'contact_name')->maxlength(255)
                ->rules('required')->required(),

            Text::make(__('Contact Tel'), 'contact_tel')->maxlength(255),

            Text::make(__('Contact Cel'), 'contact_cel')->maxlength(255),

            Select::make(__('Order Method'), 'order_method')
                ->options(OrderMethod::array())->displayUsingLabels(),

            Currency::make(__('Min Order Price'), 'min_order_price')
                ->rules('required')->required()
                ->default(0),

            Boolean::make(__('Is Parceled'), 'is_parceled'),

            Textarea::make(__('Additional Information'), 'additional_information')->alwaysShow(),

            Stack::make(__('Created At').' & '.__('Updated At'), [
                DateTime::make(__('Created At'), 'created_at'),
                DateTime::make(__('Updated At'), 'updated_at'),
            ])->hideFromIndex(),

            HasMany::make(__('Boxes'), 'boxes', Box::class),

            HasMany::make(__('Box Purchase Orders'), 'boxPurchaseOrders', BoxPurchaseOrder::class),
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
        return __('Box Supplier');
    }
}
