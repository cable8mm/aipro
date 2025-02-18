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
	<h2>{{ __('Order Sheet') }}</h2>
	<div class="times">
		<div class="order-time">
			주문시간 : {{ $order->latestOrderShipment->orderDate }}
		</div>
		<div class="print-time">
			출력시간 : {{ date('Y-m-d H:i:s') }}
		</div>
	</div>
	<div class="order-info">
		<div class="order-no">
			주문번호 : <strong>{{ $order->id }}</strong>
		</div>
		<div class="order-barcode">
			<img src="{{ url('api/generate-barcode', $order->id) }}"
				width="80%" height="50" />
		</div>
	</div>

    @if ($order->waybill_numbers)
	<div class="waybill-info">
		<div class="waybill-no">
			송장번호 : <strong>{{ $order->waybill_numbers }}</strong>
		</div>
		<div class="waybill-barcode">
			<img src="{{ url('api/generate-barcode', $order->waybill_numbers) }}"
				width="80%" height="50" />
		</div>
	</div>
    @endif

	<table class="goods-list" cellpadding="1" cellspacing="1" border="0">
		<tr>
			<th style="width:50px;">No</th>
			<th style="width:70px;">{{ __('Master Code') }}</th>
			<th style="width:200px">상품명</th>
			<th style="width:70px;">구역번호</th>
			<th style="width:50px;">수량</th>
			<th style="width:50px;">공급사</th>
			<th style="width:60px;">구분</th>
			<th>비고</th>
		</tr>
        @foreach ($order->orderShipments as $item)
		<tr>
			<td>{{$loop->iteration}}
			</td>
			<td>{{ $item->good->sku }}
			</td>
			<td class="left">
				<strong style="margin-bottom: 5px; display: block;">{{ $item->good->name ?? '미매칭상품 (확인필요)' }}</strong><br /><br />
				<span style="font-size:11px;">{{ $item->goodsNm }}</span>
                @isset($item->option)
                <br /><span style='color: #333; font-size:10px;'><strong>옵션명 :</strong>{{ $item->option }}</span>
                @endisset
			</td>
			<td>
                {{ $item->good->picking_zone_number }}
			</td>
			<td>
				주문: {{ $item->totalAmount }}<br />
				재고: {{ $item->good->inventory }}
			</td>
			<td class="left">
                {{ $item->good->supplier->name ?? '' }}
			</td>
			<td class="">
                {{ $item->good->center_class }}, {{ $item->good->safe_class }}
			</td>
			<td class="left" valign="top">
                @if ($item->memo)
                    {{ $item->memo }}
                @endif
                {{ $item->completed_at }}
			</td>
		</tr>
        @endforeach
	</table>

	<div class="delivery-info">
		<div class="order">
			<strong>▶︎주문자정보</strong>
			<table cellpadding="1" cellspacing="1" border="0">
				<tr>
					<th>구매채널</th>
					<td>
                        {{ $order->latestOrderShipment->site }}
					</td>
				</tr>
				<tr>
					<th>주문자</th>
					<td>
                        {{ $order->latestOrderShipment->orderName }}
					</td>
				</tr>
				<tr>
					<th>연락처</th>
					<td>
                        {{ $order->latestOrderShipment->orderCellPhone }}
					</td>
				</tr>
				<tr>
					<th>주문일</th>
					<td>
                        {{ $order->latestOrderShipment->orderDate }}
					</td>
				</tr>
			</table>
		</div>
		<div class="receiver">
			<strong>▶︎수령자정보</strong>
			<table cellpadding="1" cellspacing="1" border="0">
				<tr>
					<th>수령자</th>
					<td>
                        {{ $order->latestOrderShipment->receiverName }}
					</td>
				</tr>
				<tr>
					<th>연락처</th>
					<td>
                        @isset($order->latestOrderShipment->receiverPhone)
                        {{ $order->latestOrderShipment->receiverPhone }} /
                        @endisset
                        {{ $order->latestOrderShipment->receiverCellPhone }}
					</td>
				</tr>
				<tr>
					<th>주소</th>
					<td>
                        {{ $order->latestOrderShipment->address }}
					</td>
				</tr>
			</table>
		</div>
	</div>

	<div class="delivery-memo" style="display: none;">
		<div class="memo">
			<strong>▶︎요청사항/상담메모</strong>
			<table cellpadding="1" cellspacing="1" border="0">
				<tr>
					<th>고객요청사항</th>
					<td>
                        {{ $order->orderSheetWaybill->deliveryMemo }}
					</td>
				</tr>
				<tr>
					<th>고객상담메모</th>
					<td></td>
				</tr>
			</table>
		</div>
	</div>
</div>
</body>
</html>
