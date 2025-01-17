<?php

namespace App\Nova;

use App\Enums\Site;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class OrderShipment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\OrderShipment>
     */
    public static $model = \App\Models\OrderShipment::class;

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
            BelongsTo::make(__('Order Sheet Invoice'), 'orderSheetInvoice', OrderSheetInvoice::class),
            Text::make('OrderNo', 'orderNo')->maxlength(255),
            Select::make('Site', 'site')->options(Site::array())->displayUsingLabels(),
            Text::make('RegistDate', 'registDate')->maxlength(255),
            Text::make('OrderDate', 'orderDate')->maxlength(255),
            Text::make('PaymentDate', 'paymentDate')->maxlength(255),
            Text::make('StatusDate', 'statusDate')->maxlength(255),
            Text::make('DeliveryDate', 'deliveryDate')->maxlength(255),
            Text::make('Status', 'status')->maxlength(255),
            Text::make('SiteOrderNo', 'siteOrderNo')->maxlength(255),
            Text::make('SiteGoodsCd', 'siteGoodsCd')->maxlength(255),
            Text::make('GoodsNm', 'goodsNm')->maxlength(255),
            Text::make('Option', 'option')->maxlength(255),
            Number::make('OptionPrice', 'optionPrice'),
            Text::make('AdditionalOption', 'additionalOption')->maxlength(255),
            Number::make('AdditionalOptionPrice', 'additionalOptionPrice'),
            Number::make('CostPrice', 'costPrice'),
            Number::make('FixedPrice', 'fixedPrice'),
            Number::make('TotalPrice', 'totalPrice'),
            Number::make('Amount', 'amount'),
            Number::make('TotalAmount', 'totalAmount'),
            Number::make('ConfirmAmount', 'confirmAmount'),
            Text::make('DeliveryType', 'deliveryType')->maxlength(255),
            Number::make('DeliveryPrice', 'deliveryPrice'),
            Number::make('TotalDeliveryPrice', 'totalDeliveryPrice'),
            Text::make('OrderName', 'orderName')->maxlength(255),
            Text::make('OrderPhone', 'orderPhone')->maxlength(255),
            Text::make('OrderCellPhone', 'orderCellPhone')->maxlength(255),
            Text::make('ReceiverName', 'receiverName')->maxlength(255),
            Text::make('ReceiverPhone', 'receiverPhone')->maxlength(255),
            Text::make('ReceiverCellPhone', 'receiverCellPhone')->maxlength(255),
            Text::make('Postcode', 'postcode')->maxlength(255),
            Text::make('Address', 'address')->maxlength(255),
            Text::make('DeliveryMemo', 'deliveryMemo'),
            Text::make('InvoiceCompany', 'invoiceCompany')->maxlength(255),
            Text::make('InvoiceNo', 'invoiceNo')->maxlength(255),
            Text::make('InvoiceFilePath', 'invoiceFilePath')->maxlength(255),
            Number::make('InvoiceFilePage', 'invoiceFilePage'),
            Text::make('InvoiceGoodsCd', 'invoiceGoodsCd')->maxlength(255),
            Text::make('PayGoodsCd', 'payGoodsCd')->maxlength(190),
            Text::make('MasterGoodsCd', 'masterGoodsCd')->maxlength(255),
            Text::make('Memo', 'memo'),
            Number::make('Validator', 'validator'),
            Text::make('IsSet', 'isSet')->maxlength(1),
            Text::make('Printed', 'printed')->maxlength(1),
            Text::make('Downloaded', 'downloaded')->maxlength(1),
            Text::make('Shipped', 'shipped')->maxlength(1),
            Text::make('Boxes', 'boxes')->maxlength(255),
            Text::make('Shippable', 'shippable')->maxlength(1),
            Number::make('Inventory', 'inventory'),
            DateTime::make('Printed At', 'printed_at')->exceptOnForms(),
            DateTime::make('Downloaded At', 'downloaded_at')->exceptOnForms(),
            DateTime::make('Shipped At', 'shipped_at')->exceptOnForms(),
            DateTime::make('Completed At', 'completed_at')->exceptOnForms(),
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
        return __('Order Shipments');
    }
}
