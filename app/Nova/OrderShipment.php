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
            Text::make('OrderNo')->maxlength(255),
            Select::make('Site')->options(Site::array())->displayUsingLabels(),
            Text::make('RegistDate')->maxlength(255),
            Text::make('OrderDate')->maxlength(255),
            Text::make('PaymentDate')->maxlength(255),
            Text::make('StatusDate')->maxlength(255),
            Text::make('DeliveryDate')->maxlength(255),
            Text::make('Status')->maxlength(255),
            Text::make('SiteOrderNo')->maxlength(255),
            Text::make('SiteGoodsCd')->maxlength(255),
            Text::make('GoodsNm')->maxlength(255),
            Text::make('Option')->maxlength(255),
            Number::make('OptionPrice'),
            Text::make('AdditionalOption')->maxlength(255),
            Number::make('AdditionalOptionPrice'),
            Number::make('CostPrice'),
            Number::make('FixedPrice'),
            Number::make('TotalPrice'),
            Number::make('Amount'),
            Number::make('TotalAmount'),
            Number::make('ConfirmAmount'),
            Text::make('DeliveryType')->maxlength(255),
            Number::make('DeliveryPrice'),
            Number::make('TotalDeliveryPrice'),
            Text::make('OrderName')->maxlength(255),
            Text::make('OrderPhone')->maxlength(255),
            Text::make('OrderCellPhone')->maxlength(255),
            Text::make('ReceiverName')->maxlength(255),
            Text::make('ReceiverPhone')->maxlength(255),
            Text::make('ReceiverCellPhone')->maxlength(255),
            Text::make('Postcode')->maxlength(255),
            Text::make('Address')->maxlength(255),
            Text::make('DeliveryMemo'),
            Text::make('InvoiceCompany')->maxlength(255),
            Text::make('InvoiceNo')->maxlength(255),
            Text::make('InvoiceFilePath')->maxlength(255),
            Number::make('InvoiceFilePage'),
            Text::make('InvoiceGoodsCd')->maxlength(255),
            Text::make('PayGoodsCd')->maxlength(190),
            Text::make('MasterGoodsCd')->maxlength(255),
            Text::make('Memo'),
            Number::make('Validator'),
            Text::make('IsSet')->maxlength(1),
            Text::make('Printed')->maxlength(1),
            Text::make('Downloaded')->maxlength(1),
            Text::make('Shipped')->maxlength(1),
            Text::make('Boxes')->maxlength(255),
            Text::make('Shippable')->maxlength(1),
            Number::make('Inventory'),
            DateTime::make('Printed At')->exceptOnForms(),
            DateTime::make('Downloaded At')->exceptOnForms(),
            DateTime::make('Shipped At')->exceptOnForms(),
            DateTime::make('Completed At')->exceptOnForms(),
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
}
