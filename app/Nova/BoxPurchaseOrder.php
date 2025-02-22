<?php

namespace App\Nova;

use App\Enums\PurchaseOrderStatus;
use App\Traits\NovaAuthorizedByWarehouser;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class BoxPurchaseOrder extends Resource
{
    use NovaAuthorizedByWarehouser;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\BoxPurchaseOrder>
     */
    public static $model = \App\Models\BoxPurchaseOrder::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title',
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
            Status::make(__('Status'), 'status')
                ->loadingWhen(PurchaseOrderStatus::loadingWhen())
                ->failedWhen(PurchaseOrderStatus::failedWhen())
                ->filterable(function ($request, $query, $value, $attribute) {
                    $query->where($attribute, $value);
                })->displayUsing(function ($value) {
                    return PurchaseOrderStatus::{$value}->value() ?? '-';
                }),
            Hidden::make('Author', 'author_id')->default(function ($request) {
                return $request->user()->id;
            }),
            BelongsTo::make(__('Warehouse Manager'), 'warehouseManager', User::class),
            BelongsTo::make(__('Box Supplier'), 'boxSupplier', BoxSupplier::class),
            Text::make(__('Title'), 'title')->rules('required')->required()->maxlength(190),
            Number::make(__('Total Box Count'), 'total_box_count')->displayUsing(function ($value) {
                return number_format($value);
            }),
            Currency::make(__('Total Order Price'), 'total_order_price'),
            DateTime::make(__('Ordered At'), 'ordered_at')->nullable()->filterable(),
            DateTime::make(__('Predict Warehoused At'), 'predict_warehoused_at')->nullable()->filterable(),
            DateTime::make(__('Sent At'), 'sent_at')->nullable()->exceptOnForms(),
            DateTime::make(__('Confirmed At'), 'confirmed_at')->nullable()->exceptOnForms(),
            DateTime::make(__('Warehoused At'), 'warehoused_at')->nullable()->exceptOnForms(),
            Textarea::make(__('Memo'), 'memo')->alwaysShow(),

            HasMany::make(__('Purchase Order Boxes'), 'purchaseOrderBoxes', PurchaseOrderBox::class),
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
        return __('Box Purchase Order And Warehousing');
    }
}
