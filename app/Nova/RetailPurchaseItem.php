<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class RetailPurchaseItem extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\RetailPurchaseItem>
     */
    public static $model = \App\Models\RetailPurchaseItem::class;

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
        'retailPurchase.code',
        'item.name',
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

            BelongsTo::make(__('Retail Purchase'), 'retailPurchase', RetailPurchase::class),

            BelongsTo::make(__('Item'), 'item', Item::class),

            Number::make(__('Quantity'), 'quantity')->default(1),

            // @see https://laracasts.com/discuss/channels/nova/nova-4-dependson-on-a-belongsto-relationship
            Currency::make(__('Unit Price'), 'unit_price')
                ->dependsOn(
                    ['item'],
                    function (Currency $field, NovaRequest $request, FormData $formData) {
                        $itemId = (int) $formData->resource(Item::uriKey(), $formData->item);

                        if (! empty($itemId)) {
                            $item = \App\Models\Item::find($itemId);

                            $field->setValue($item->suggested_selling_price);
                        }
                    }
                ),

            Currency::make(__('Subtotal'), 'subtotal')
                ->dependsOn(
                    ['quantity', 'unit_price'],
                    function (Currency $field, NovaRequest $request, FormData $formData) {
                        if (! is_null($formData->unit_price) || ! is_null($formData->quantity)) {
                            $field->setValue($formData->unit_price * $formData->quantity);
                        }
                    }
                ),

            DateTime::make(__('Created At'), 'created_at')->exceptOnForms(),
            DateTime::make(__('Updated At'), 'updated_at')->exceptOnForms(),
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
        return __('Retail Purchase Items');
    }

    public function title()
    {
        return '['.__('Retail Purchase').']'.$this->item->name;
    }
}
