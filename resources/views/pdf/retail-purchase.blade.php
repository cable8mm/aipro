<html>

<head>
    <style>
        body {
            font-size: 10pt;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            background: #000;
        }

        th,
        td {
            background: #fff;
        }

        .times:after {
            clear: both;
        }

        .times div {
            width: 49%;
        }

        .times div.order-time {
            float: left;
        }

        .times div.print-time {
            text-align: right;
        }

        .order-info {
            border: 2px solid #000;
            margin-top: 10px;
        }

        .order-info div {
            width: 49%;
        }

        .order-info div img {
            width: 100%;
        }

        .order-info .order-no {
            padding: 20px 5px;
            float: left;
        }

        .order-info .order-no strong {
            font-size: 1.2em;
        }

        .order-info .order-barcode {
            padding: 5px 0;
            text-align: right;
        }

        .waybill-info {
            border: 1px solid #000;
            margin-top: 10px;
        }

        .waybill-info div {
            width: 49%;
        }

        .waybill-info div img {
            width: 100%;
        }

        .waybill-info .waybill-no {
            padding: 20px 5px;
            float: left;
        }

        .waybill-info .waybill-no strong {
            font-size: 1.2em;
        }

        .waybill-info .waybill-barcode {
            padding: 5px 0;
            text-align: right;
        }


        .goods-list {
            width: 100%;
            background: #000;
            margin-top: 20px;
            font-size: 10pt;
        }

        .goods-list td {
            text-align: center;
        }

        .goods-list td.left {
            text-align: left;
            padding-left: 5px;
            padding-right: 5px;
        }

        .delivery-info {
            margin-top: 20px;
        }

        .delivery-info div {
            width: 49%;
        }

        .delivery-info div.order {
            float: left;
        }

        .delivery-info div.receiver {
            float: right;
        }

        .delivery-info th {
            width: 60px;
        }

        .delivery-memo {
            margin-top: 20px;
        }

        .delivery-memo div {
            width: 49%;
        }

        .delivery-memo th {
            width: 60px;
        }

        .leaflet {
            font-size: 20px;
            text-align: right;
            font-weight: bold;
            padding-bottom: 5px;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="wrap">
        <h2>{{ __('Transaction Statement') }}</h2>
        <div class="times">
            <div class="order-time">
                {{ __('Retail Purchased At') }} : {{ $retailPurchase->purchased_at }}
            </div>
            <div class="print-time">
                {{ __('Printed At') }} : {{ now(auth()->user()?->timezone)->format('Y-m-d H:i:s') }}
            </div>
        </div>
        <div class="order-info">
            <div class="order-no">
                {{ __('Retail Purchase Code') }} : <strong>{{ $retailPurchase->code }}</strong>
            </div>
            <div class="order-barcode">
                <img src="{{ route('generate-barcode', ['barcode' => $retailPurchase->id]) }}" width="80%"
                    height="50" />
            </div>
        </div>

        <table class="goods-list" cellpadding="1" cellspacing="1" border="0">
            <tr>
                <th style="width:50px;">No</th>
                <th style="width:70px;">SKU</th>
                <th style="width:50px;">{{ __('Supplier Name') }}</th>
                <th style="width:200px">{{ __('Goods Name') }}</th>
                <th style="width:70px;">{{ __('Quantity') }}</th>
                <th style="width:50px;">{{ __('Subtotal') }}</th>
            </tr>
            @foreach ($retailPurchase->retailPurchaseItems as $retailPurchaseItem)
                <tr>
                    <td>{{ $loop->iteration }}
                    </td>
                    <td>{{ $retailPurchaseItem->item->sku }}
                    </td>
                    <td class="left">
                        {{ $retailPurchaseItem->item->supplier->name ?? '' }}
                    </td>
                    <td class="left">
                        <strong
                            style="margin-bottom: 5px; display: block;">{{ $retailPurchaseItem->item->name ?? __('Mismatched Order Goods') }}</strong><br /><br />
                        @isset($retailPurchaseItem->item->option)
                            <br /><span style='color: #333; font-size:10px;'><strong>{{ __('Option Name') }}
                                    :</strong>{{ $retailPurchaseItem->item->option }}</span>
                        @endisset
                    </td>
                    <td>
                        {{ $retailPurchaseItem->quantity }}
                    </td>
                    <td>
                        {{ Number::currency($retailPurchaseItem->subtotal) }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td>
                </td>
                <td>
                </td>
                <td class="left">
                </td>
                <td class="left">
                </td>
                <td>
                </td>
                <td>
                    {{ Number::currency($retailPurchase->total_price) }}
                </td>
            </tr>
        </table>

        <div class="delivery-info">
            <div class="order">
                <strong>▶︎{{ __('Customer Information') }}</strong>
                <table cellpadding="1" cellspacing="1" border="0">
                    <tr>
                        <th>{{ __('Customer') }}</th>
                        <td>
                            {{ $retailPurchase->customer->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Contact') }}</th>
                        <td>
                            {{ $retailPurchase->customer->contact_cel }}
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Ordered At') }}</th>
                        <td>
                            {{ $retailPurchase->created_at }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="receiver">
                <strong>▶︎{{ __('Retail Purchase Information') }}</strong>
                <table cellpadding="1" cellspacing="1" border="0">
                    <tr>
                        <th>{{ __('Cashier') }}</th>
                        <td>
                            {{ $retailPurchase->cashier->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Code') }}</th>
                        <td>
                            {{ $retailPurchase->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Payment Method') }}</th>
                        <td>
                            {{ $retailPurchase->payment_method->value() }}
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Discount') }}</th>
                        <td>
                            {{ empty($retailPurchase->discount) ? '-' : Number::currency($retailPurchase->discount) }}
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Tax') }}</th>
                        <td>
                            {{ empty($retailPurchase->tax) ? '-' : Number::currency($retailPurchase->tax) }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="delivery-memo" style="display: none;">
            <div class="memo">
                <strong>▶︎{{ __('Order Notes') }}/{{ __('Delivery Memo') }}</strong>
                <table cellpadding="1" cellspacing="1" border="0">
                    <tr>
                        <th>{{ __('Order Notes') }}</th>
                        <td>
                            {{ $retailPurchase->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Delivery Memo') }}</th>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
