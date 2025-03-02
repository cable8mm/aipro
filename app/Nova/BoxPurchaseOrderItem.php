<?php

namespace App\Nova;

use App\Enums\PurchaseOrderItemStatus;
use App\Nova\Actions\BoxPurchaseOrderItemReturned;
use App\Nova\Actions\PurchaseOrderItemStatusChanging;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class BoxPurchaseOrderItem extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\BoxPurchaseOrderItem>
     */
    public static $model = \App\Models\BoxPurchaseOrderItem::class;

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
            BelongsTo::make(__('Box Purchase Order'), 'boxPurchaseOrder', BoxPurchaseOrder::class),
            BelongsTo::make(__('Author'), 'author', User::class)
                ->exceptOnForms(),
            BelongsTo::make(__('Box'), 'box', Box::class),
            Number::make(__('Quantity'), 'quantity')
                ->rules('required')->required()
                ->default(1)
                ->help(__('If it sets the minus value, the status is going to set RETURNED automatically.')),
            Currency::make(__('Unit Price'), 'unit_price')
                ->rules('required')->required()
                ->dependsOnUpdating(
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
                ->rules('required')->required()
                ->dependsOn(
                    ['quantity', 'unit_price'],
                    function (Currency $field, NovaRequest $request, FormData $formData) {
                        if (! is_null($formData->unit_price) || ! is_null($formData->quantity)) {
                            $field->setValue($formData->unit_price * $formData->quantity);
                        }
                    }
                ),
            DateTime::make(__('Purchase Ordered At'), 'purchase_ordered_at')
                ->filterable(),
            DateTime::make(__('Warehoused At'), 'warehoused_at')
                ->filterable(),
            Status::make(__('Status'), 'status')
                ->loadingWhen(PurchaseOrderItemStatus::loadingWhen())
                ->failedWhen(PurchaseOrderItemStatus::failedWhen())
                ->filterable(function ($request, $query, $value, $attribute) {
                    $query->where($attribute, $value);
                })->displayUsing(function ($value) {
                    return PurchaseOrderItemStatus::tryFrom($value)?->value() ?? '-';
                }),
            Textarea::make(__('Memo'), 'memo')
                ->alwaysShow(),
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
        return [
            (new PurchaseOrderItemStatusChanging(PurchaseOrderItemStatus::STORED))->showInline(),
            (new PurchaseOrderItemStatusChanging(PurchaseOrderItemStatus::CANCELED))->showInline(),
            (new BoxPurchaseOrderItemReturned)->showInline(),
        ];
    }

    public static function label()
    {
        return __('Box Purchase Order Item');
    }
}
