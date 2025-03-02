<?php

namespace App\Nova;

use App\Enums\OrderShipmentDeliveryType;
use App\Enums\OrderShipmentStatus;
use App\Enums\Site;
use App\Traits\NovaAuthorizedByWarehouser;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Outl1ne\NovaInputFilter\InputFilter;

class OrderShipment extends Resource
{
    use NovaAuthorizedByWarehouser;

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
        'orderNo',
        'siteOrderNo',
        'siteGoodsCd',
        'goodsCd',
        'goodsNm',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()
                ->hideFromIndex(),
            BelongsTo::make(__('Order Sheet Waybill'), 'orderSheetWaybill', OrderSheetWaybill::class),
            HasOne::make(__('Item'), 'item', Item::class),
            BelongsTo::make(__('Order Number'), 'order', Order::class),
            Panel::make(__('Additional Information'), [
                Text::make(__('Goods Code'), 'goodsCd')->copyable(),
                Text::make(__('Seller Good Code'), 'sellerGoodsCd')->copyable(),
                Select::make(__('Site'), 'site')
                    ->options(Site::array())
                    ->displayUsingLabels(),
                Text::make(__('Regist Date'), 'registDate')->maxlength(255)
                    ->hideFromIndex(),
                Text::make(__('Order Date'), 'orderDate')->maxlength(255)
                    ->hideFromIndex(),
                Text::make(__('Status Date'), 'statusDate')->maxlength(255)
                    ->hideFromIndex(),
                Text::make(__('Delivery Date'), 'deliveryDate')->maxlength(255)
                    ->hideFromIndex(),
                Text::make(__('Site Order No'), 'siteOrderNo')->maxlength(255)->copyable(),
                Text::make(__('Site Goods Cd'), 'siteGoodsCd')->maxlength(255)->copyable(),
                Boolean::make(__('Printed'), 'printed')
                    ->trueValue('Y')
                    ->falseValue('N'),
                Select::make(__('Status'), 'status')
                    ->options(OrderShipmentStatus::array())
                    ->filterable(),
                Text::make(__('Memo'), 'memo'),
                DateTime::make(__('Completed At'), 'completed_at')->exceptOnForms(),
                Text::make(__('Goods Nm'), 'goodsNm')->maxlength(255),
                Text::make(__('Option'), 'option')->maxlength(255),
                Currency::make(__('Option Price'), 'optionPrice')
                    ->hideFromIndex(),
                Text::make(__('Additional Option'), 'additionalOption')->maxlength(255)
                    ->hideFromIndex(),
                Currency::make(__('Additional Option Price'), 'additionalOptionPrice')
                    ->hideFromIndex(),
                Currency::make(__('Cost Price'), 'costPrice')
                    ->hideFromIndex(),
                Currency::make(__('Fixed Price'), 'fixedPrice')
                    ->hideFromIndex(),
                Currency::make(__('Total Price'), 'totalPrice')
                    ->hideFromIndex(),
                Number::make(__('Amount'), 'amount'),
                Number::make(__('Total Amount'), 'totalAmount')
                    ->displayUsing(fn ($value) => number_format($value)),
                Number::make(__('Confirm Amount'), 'confirmAmount')
                    ->displayUsing(fn ($value) => number_format($value)),
                Number::make(__('Validator'), 'validator')
                    ->hideFromIndex(),
                Select::make(__('Delivery Type'), 'deliveryType')
                    ->options(OrderShipmentDeliveryType::array())
                    ->displayUsingLabels(),
                Currency::make(__('Delivery Price'), 'deliveryPrice')
                    ->hideFromIndex(),
                Currency::make(__('Total Delivery Price'), 'totalDeliveryPrice')
                    ->hideFromIndex(),
                Text::make(__('Order Name'), 'orderName')->maxlength(255)
                    ->hideFromIndex(),
                Text::make(__('Order Phone'), 'orderPhone')->maxlength(255)
                    ->hideFromIndex(),
                Text::make(__('Order Cell Phone'), 'orderCellPhone')->maxlength(255)
                    ->hideFromIndex(),
                Text::make(__('Receiver Name'), 'receiverName')->maxlength(255),
                Text::make(__('Receiver Phone'), 'receiverPhone')->maxlength(255),
                Text::make(__('Receiver Cell Phone'), 'receiverCellPhone')->maxlength(255),
                Text::make(__('Postcode'), 'postcode')->maxlength(255)
                    ->hideFromIndex(),
                Text::make(__('Address'), 'address')->maxlength(255)
                    ->hideFromIndex(),
                Text::make(__('Delivery Memo'), 'deliveryMemo'),
                Text::make(__('Waybill Company'), 'waybillCompany')->maxlength(255),
                Text::make(__('Waybill No'), 'waybillNo')->maxlength(255),
                Text::make(__('Waybill File Path'), 'waybillFilePath')->maxlength(255)
                    ->hideFromIndex(),
                Number::make(__('Waybill File Page'), 'waybillFilePage'),
                Text::make(__('Waybill Goods Cd'), 'waybillGoodsCd')->maxlength(255)
                    ->hideFromIndex(),
                Text::make(__('Pay Goods Cd'), 'payGoodsCd')->maxlength(190)
                    ->hideFromIndex(),
                Text::make(__('Payment Date'), 'paymentDate')->maxlength(255),
                Boolean::make(__('Is Set'), 'isSet')
                    ->trueValue('Y')
                    ->falseValue('N')
                    ->hideFromIndex(),
                Boolean::make(__('Downloaded'), 'downloaded')
                    ->trueValue('Y')
                    ->falseValue('N')
                    ->hideFromIndex(),
                Boolean::make(__('Shipped'), 'shipped')
                    ->trueValue('Y')
                    ->falseValue('N')
                    ->hideFromIndex(),
                Text::make(__('Boxes'), 'boxes')->maxlength(255)
                    ->hideFromIndex(),
                Boolean::make(__('Shippable'), 'shippable')
                    ->trueValue('Y')
                    ->falseValue('N')
                    ->hideFromIndex(),
                Number::make(__('Inventory'), 'inventory')
                    ->displayUsing(fn ($value) => number_format($value))
                    ->hideFromIndex(),
                DateTime::make(__('Printed At'), 'printed_at')->exceptOnForms()
                    ->hideFromIndex(),
                DateTime::make(__('Downloaded At'), 'downloaded_at')->exceptOnForms()
                    ->hideFromIndex(),
                DateTime::make(__('Shipped At'), 'shipped_at')->exceptOnForms()
                    ->hideFromIndex(),
                DateTime::make(__('Created At'), 'created_at')->exceptOnForms()->filterable(),
            ])->limit(3),
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
            InputFilter::make()->forColumns(['order_sheet_waybill_id'])->withName(__('Order Sheet Waybill').' ID'),
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
        return __('Order Shipments');
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    // public function authorizedToUpdate(Request $request)
    // {
    //     return false;
    // }
}
