<?php

namespace App\Nova;

use App\Enums\PaymentMethod;
use App\Enums\RetailPurchaseStatus;
use App\Nova\Actions\RetailPurchaseStatusChanging;
use App\Nova\Filters\RetailPurchaseStatusFilter;
use App\Nova\Metrics\NewRetailPurchase;
use App\Nova\Metrics\RetailPurchasePerDay;
use App\Nova\Metrics\RetailPurchaseSumPaymentMethod;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class RetailPurchase extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\RetailPurchase>
     */
    public static $model = \App\Models\RetailPurchase::class;

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
        'code',
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
            BelongsTo::make(__('Cashier'), 'cashier', User::class)->exceptOnForms(),
            BelongsTo::make(__('Customer'), 'customer', Customer::class)
                ->showCreateRelationButton()
                ->modalSize('4xl')
                ->filterable(),
            Text::make(__('Code'), 'code')->exceptOnForms(),
            Number::make(__('Item Count'), 'item_count')->exceptOnForms(),
            Currency::make(__('Total Price'), 'total_price')->exceptOnForms(),
            Select::make(__('Payment Method'), 'payment_method')
                ->options(PaymentMethod::array())->displayUsingLabels()
                ->filterable(),
            Status::make(__('Status'), 'status')
                ->loadingWhen(RetailPurchaseStatus::loadingWhen())
                ->failedWhen(RetailPurchaseStatus::failedWhen())
                ->displayUsing(function ($value) {
                    return RetailPurchaseStatus::{$value}->value() ?? '-';
                }),
            Currency::make(__('Discount'), 'discount')->default(0),
            Currency::make(__('Tax'), 'tax')->exceptOnForms(),
            Date::make(__('Purchased At'), 'purchased_at')->default(now()),
            Textarea::make(__('Notes'), 'notes')->nullable()->alwaysShow(),
            Stack::make(__('Created At').' & '.__('Updated At'), [
                DateTime::make(__('Created At'), 'created_at'),
                DateTime::make(__('Updated At'), 'updated_at'),
            ]),

            HasMany::make(__('Retail Purchase Items'), 'retailPurchaseItems', RetailPurchaseItem::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            new RetailPurchaseSumPaymentMethod,
            new NewRetailPurchase,
            new RetailPurchasePerDay,
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            new RetailPurchaseStatusFilter,
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
        return [
            (new RetailPurchaseStatusChanging(RetailPurchaseStatus::COMPLETED))->showInline(),
            (new RetailPurchaseStatusChanging(RetailPurchaseStatus::CANCELED))->showInline(),
            (new RetailPurchaseStatusChanging(RetailPurchaseStatus::REFUNDED))->showInline(),
        ];
    }

    public static function label()
    {
        return __('Retail Purchases');
    }

    public function title()
    {
        return $this->code;
    }
}
