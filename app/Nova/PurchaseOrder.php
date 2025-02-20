<?php

namespace App\Nova;

use App\Enums\PurchaseOrder as EnumsPurchaseOrder;
use App\Traits\NovaAuthorizedByWarehouser;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class PurchaseOrder extends Resource
{
    use NovaAuthorizedByWarehouser;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PurchaseOrder>
     */
    public static $model = \App\Models\PurchaseOrder::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'code';

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
            BelongsTo::make(__('Warehouse Manager'), 'warehouseManager', User::class)
                ->showCreateRelationButton(),
            BelongsTo::make(__('Supplier'), 'supplier', Supplier::class)->filterable()
                ->showCreateRelationButton()
                ->modalSize('4xl'),
            Text::make(__('Code'), 'code')->exceptOnForms(),
            Number::make(__('Total Good Count'), 'total_good_count')->exceptOnForms()->displayUsing(function ($value) {
                return number_format($value);
            }),
            Currency::make(__('Total Order Price'), 'total_order_price')->exceptOnForms(),
            Number::make(__('Order Discount Percent'), 'order_discount_percent')->min(1)->max(100)->step(1)
                ->displayUsing(fn () => "{$this->order_discount_percent}%")
                ->exceptOnForms(),
            Stack::make(__('Dates'), [
                DateTime::make(__('Ordered At'), 'ordered_at')
                    ->displayUsing(fn ($value) => __('Order').' : '.($value ? $value->toDateTimeString() : '-'))
                    ->nullable()->filterable(),
                DateTime::make(__('Predict Warehoused At'), 'predict_warehoused_at')
                    ->displayUsing(fn ($value) => __('Predict Warehousing').' : '.($value ? $value->toDateTimeString() : '-'))
                    ->nullable()->filterable(),
                DateTime::make(__('Sent At'), 'sent_at')
                    ->displayUsing(fn ($value) => __('Sending').' : '.($value ? $value->toDateTimeString() : '-'))
                    ->exceptOnForms(),
                DateTime::make(__('Confirmed At'), 'confirmed_at')
                    ->displayUsing(fn ($value) => __('Confirm').' : '.($value ? $value->toDateTimeString() : '-'))
                    ->exceptOnForms(),
            ]),
            DateTime::make(__('Warehoused At'), 'warehoused_at')->displayUsing(fn ($value) => $value ? $value->toDateTimeString() : '-')->exceptOnForms(),
            Textarea::make(__('Memo'), 'memo')->alwaysShow(),
            Status::make(__('Status'), 'status')
                ->loadingWhen(EnumsPurchaseOrder::loadingWhen())
                ->failedWhen(EnumsPurchaseOrder::failedWhen())
                ->filterable(function ($request, $query, $value, $attribute) {
                    $query->where($attribute, $value);
                })->displayUsing(function ($value) {
                    return EnumsPurchaseOrder::{$value}->value() ?? '-';
                }),
            Stack::make(__('Created At').' & '.__('Updated At'), [
                DateTime::make(__('Created At'), 'created_at')->displayUsing(fn ($value) => $value ? $value->toDateTimeString() : '-'),
                DateTime::make(__('Updated At'), 'updated_at')->displayUsing(fn ($value) => $value ? $value->toDateTimeString() : '-'),
            ])->hideFromIndex(),

            HasMany::make(__('Purchase Order Items'), 'purchaseOrderItems', PurchaseOrderItem::class),
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
        return [
            new Filters\PurchaseOrderFinished,
        ];
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
        return __('Purchase Order And Warehousing');
    }
}
