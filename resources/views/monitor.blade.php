<x-inspection-layout>
<script>
	var Shipping = {
		scanMode: 'normal',
		scanned: false,
		orderNo: "",
		lastBarcode: null,
		confirmed: false,
		validatorId: "{{ auth()->user()->id ?? null }}",
		init: function() {
			$(window).ready(function() {
				$("#barcode").focus();

				$("#barcode").blur(function() {
					$(this).focus();
				});


				$("#barcode").change(function() {

				});

				$("#barcode").keydown(function(e) {
					// 엔터와 숫자인 경우만
					if (e.keyCode == 13) {
						var barcode = $(this).val();

						Shipping.scanned = false;

						// 송장입력모드이면
						if (Shipping.scanMode == 'waybill') {
							Shipping.setWaybill(barcode);
							Shipping.scanMode = 'normal';
							return;
						}

						// 커맨드 바코드 스캔
						if (barcode.startsWith("90000")) {
							switch (barcode) {
								case "90000001000019": // 강제검수
									if (Shipping.lastBarcode) {
										Shipping.confirmGoods(Shipping.lastBarcode, true);
									}
									break;
								case "90000001000026": // 검수완료
									Shipping.save();
									break;
								case "90000001000071": // 부분검수완료
									Shipping.save('partial');
									break;
								case "90000001000033": // 검수취소
									location.reload();
									break;
								case "90000001000040": // 임시저장
									Shipping.save('temporary');
									break;
								case "90000001000057": // 임시저장취소
									Shipping.clearTempOrder();
									break;
								case "90000001000064": // 송장입력
									Shipping.scanMode = "waybill";
									break;
								case "90000001000095": // 스크롤업
									$('html, body').animate({
										scrollTop: $("html").scrollTop() - document
											.documentElement.clientHeight / 2
									}, 500);
									break;
								case "90000001000101": // 스크롤다운
									$('html, body').animate({
										scrollTop: $("html").scrollTop() + document
											.documentElement.clientHeight / 2
									}, 500);
									break;
								case "90000001000118": // 송장출력
									printJS({
										printable: "/api/orders/" + Shipping.orderInfo.orderNo + "/waybill",
										type: "pdf",
										showModal: true,
										modalMessage: "송장 미리보기 생성 중..."
									});
									break;
                                @foreach ($boxes as $key => $boxName)
                                case "{{ \App\Support\Gtin::ofBox($key) }}":
                                    {!! 'Shipping.addBox('.$key.', \''.$boxName.'\');' !!}
                                    break;
                                @endforeach
								case "90000001010001": // 규격 외 박스
									Shipping.anotherBox();
									break;
								case "90000001010018": // 박스삭제
									Shipping.removeBox();
									break;
							}

							$("#barcode").val(Shipping.orderNo);

						} else if (barcode.startsWith("000") ||
							barcode.length == 12) { // 주문 바코드 스캔(송장 포함), 송장번호는 12자리!

							// var id = barcode.replace(/^0+([0-9]+)[0-9]/, "$1");

							Shipping.lastBarcode = null;
							Shipping.confirmed = false;

							Shipping.getOrderDetail(
								barcode
							); // 주문번호(OrderShipment.id) 혹은 송장 번호(OrderShipment.waybillNo)

						} else { // 상품 완료

							$("#barcode").val(Shipping.orderNo);

							Shipping.confirmGoods(barcode);
						}

					} else if ((e.keyCode >= 48 && e.keyCode <= 57) ||
						(e.keyCode >= 65 && e.keyCode <= 90)) {
						if (!Shipping.scanned) {
							Shipping.scanned = true;
							$(this).val("");
						}
					} else {
						// back, esc, 왼쪽, 오른쪽, r, F5, i 허용
						if ([27, 8, 37, 39, 82, 116, 73].indexOf(e.keyCode) == -1) {
							e.preventDefault();
							e.stopImmediatePropagation();
							return;
						}
					}
				});

				Shipping.getTempOrderCount();
			});
		},

		removeBox: function() {
			if (!Shipping.orderNo) {
				Shipping.showWarning("주문서 바코드를 먼저 스캔하세요.");
				$("#barcode").val("");
				return;
			}
			$('html, body').animate({
				scrollTop: $(".boxes").offset().top
			}, 500);

			var lastRow = $(".boxes tr:last");

			var quantityEl = lastRow.find(".quantity");
			var quantity = parseInt(quantityEl.text());

			if (quantity > 1) {
				quantityEl.text(quantity - 1);
			} else {
				lastRow.remove();
			}
		},

		anotherBox: function() {
			if (!Shipping.orderNo) {
				Shipping.showWarning("주문서 바코드를 먼저 스캔하세요.");
				$("#barcode").val("");
				return;
			}
			$('html, body').animate({
				scrollTop: $(".boxes").offset().top
			}, 500);

			var box = "";

			$(".boxes").empty();
			box = "박스 없음";

			$(".boxes .message").remove();

			var data = {
				no: $(".boxes tr").length + 1,
				size: "1000",
				box: box,
				quantity: 1
			};

			$("#box-item").tmpl(data).appendTo(".boxes");
		},

		addBox: function(size, name) {
			if (!Shipping.orderNo) {
				Shipping.showWarning("주문서 바코드를 먼저 스캔하세요.");
				$("#barcode").val("");
				return;
			}
			$('html, body').animate({
				scrollTop: $(".boxes").offset().top
			}, 500);

			var box = "";
			$("tr[data-box-size='1000']").remove();

			var boxRow = $("tr[data-box-size='" + size + "']");
			if (boxRow.length > 0) {
				var quantityEl = boxRow.find(".quantity");
				var quantity = parseInt(quantityEl.text()) + 1;
				quantityEl.text(quantity);

				return;
			} else {
				box = name;
			}

			$(".boxes .message").remove();

			var data = {
				no: $(".boxes tr").length + 1,
				size: size,
				box: box,
				quantity: 1
			};

			$("#box-item").tmpl(data).appendTo(".boxes");
		},

		setWaybill: function(barcode) {
			if (!Shipping.orderNo) {
				Shipping.showWarning("주문서 바코드를 먼저 스캔하세요.");
				$("#barcode").val("");
				return;
			}
			$('html, body').animate({
				scrollTop: $(".waybills").offset().top
			}, 500);

			$(".waybills .message").remove();

			if ($("tr[data-waybill='" + barcode + "']").length > 0) {
				return;
			}

			var data = {
				no: $(".waybills tr").length + 1,
				waybill: barcode,
			};

			$("#waybill-item").tmpl(data).appendTo(".waybills");
		},

		confirmGoods: function(barcode, force) {

			console.log("barcode = " + barcode);

			var itemRow = $("tr[data-barcode='" + barcode + "']:not(.confirmed):first");

			if (itemRow.length == 0) {
				var centerCode = barcode.replace(/^800[0]*([0-9]+)[0-9]/, "$1");
				itemRow = $("tr[data-goods-cd='" + centerCode + "']:not(.confirmed):first");

				console.log("centerCode = " + centerCode);
			}

			if (itemRow.length == 0) {
				Shipping.showWarning("이 상품은 현재 주문서에 포함되지 않은 상품입니다.");
				return;
			}

			var inventory = parseInt(itemRow.find(".inventory").text());

			/*
			if (inventory < 1) {
			    Shipping.showWarning("재고가 없는 상품입니다.");
			    return;
			}
			*/

			var amountEl = itemRow.find(".confirm-amount");

			var orderAmount = parseInt(itemRow.data("order-amount"));
			var newAmount = force ? orderAmount : parseInt(amountEl.text()) + 1;

			amountEl.text(newAmount);

			if (orderAmount == newAmount) {
				itemRow.addClass('confirmed');
				itemRow.removeClass('warning');

				var goodsCount = $(".list-goods tr").length - 1;
				var confirmedCount = $(".confirmed").length;

				if (goodsCount == confirmedCount) {
					Shipping.confirmedAll();
				}
			} else if (orderAmount < newAmount) {
				itemRow.removeClass('confirmed');
				itemRow.addClass('warning');
			}

			$('html, body').animate({
				scrollTop: itemRow.offset().top - 300
			}, 500);

			Shipping.flashRow(itemRow);

			Shipping.lastBarcode = barcode;
		},

		confirmedAll: function() {
			Shipping.confirmed = true;

			$(".message-box").empty();
			$("#complete-message").tmpl({
				completed: moment().format("YYYY-MM-DD HH:mm:ss")
			}).appendTo(".message-box");
			$(".modal-completed").fadeIn();
			setTimeout(function() {
				$(".modal-completed").fadeOut();
			}, 1000);
		},

		flashRow: function(el) {
			var cls = $(el).prop("class");
			$(el).prop("class", "").addClass("flash");
			setTimeout(function() {
				$(el).prop("class", cls);
			}, 500);
		},

		showWarning: function(message) {
			$(".message-box").text(message);

			$(".modal-warning").fadeIn("fast");
			setTimeout(function() {
				$(".modal-warning").fadeOut("fast");
			}, 1000);
		},

		getOrderDetail: function(id) {
			console.log("request : /api/order-shipments/order/" + id);

			$.get("/api/order-shipments/order/" + id, function(data) {
				if (data.result == "success" && data.orders) {

					console.log(data);

					if (data.orders.length == 0) {
						Shipping.showWarning("바코드와 매칭된 주문서가 없습니다.")
						$("#barcode").val("");
						return;
					}
					$(".goods").empty();
					$(".boxes").empty();
					$(".waybills").empty();

					$("#box-message").tmpl().appendTo(".boxes");
					$("#waybill-message").tmpl().appendTo(".waybills");

					$("footer .order-info").show();

					var order = data.orders[0].OrderShipment;

					if (order.status == "검수완료") {
						Shipping.showWarning("검수완료된 주문입니다.");
					}

					Shipping.orderNo = order.orderNo;
					$("#barcode").val(order.orderNo);

					Shipping.orderInfo = order;

					$(".order-shipments-memo").text(order.memo || "-");
					$(".orderNo").text(order.orderNo);
					$(".orderName").text(order.orderName);
					$(".receiverName").text(order.receiverName);

					if (order.boxes) {
						var boxes = JSON.parse(order.boxes);

						$(".boxes .message").remove();
						$(boxes).each(function() {

							var data = {
								no: $(".boxes tr").length + 1,
								size: this.size,
								box: this.size == 10 ? "박스 없음" : "택배박스 " + this.size + "호",
								quantity: this.quantity
							};

							$("#box-item").tmpl(data).appendTo(".boxes");
						});
					}

					if (order.waybillNo) {
						var waybillNos = order.waybillNo.split(",");

						$(".waybills .message").remove();

						$(waybillNos).each(function() {

							var data = {
								no: $(".waybills tr").length + 1,
								waybill: this,
							};

							$("#waybill-item").tmpl(data).appendTo(".waybills");
						});
					}

					var orderAmount = 0;
					var confirmAmount = 0;

					for (var i = 0; i < data.orders.length; i++) {
						var order = data.orders[i].OrderShipment;
						var ctGoods = data.orders[i].CtGood;

						var item = {
							id: order.id,
							no: i + 1,
							picking_box_number: ctGoods.picking_box_number || "",
							center_code: ctGoods.center_code,
							goods_name: ctGoods.godo_name || order.goodsNm,
							amount: order.amount * (order.isSet != "Y" ? (ctGoods.ship_quantity ||
								1) : 1),
							confirmAmount: order.confirmAmount || 0,
							inventory: ctGoods.inventory || 0,
							list_image: ctGoods.list_image || "/images/no-image.jpg",
						};
						item.barcode = ctGoods.barcode || ctGoods.generated_barcode;

						var itemEl = $("#goods-item").tmpl(item);
						itemEl.appendTo(".goods");

						if (item.amount == item.confirmAmount) {
							itemEl.addClass("confirmed");
						}

						orderAmount += item.amount;
						confirmAmount += item.confirmAmount;
					}

					if (orderAmount == confirmAmount) {
						Shipping.confirmed = true;
					}

				}
			});
		},

		save: function(mode) {
			if (!mode) mode = "complete";

			var items = [];
			var boxes = [];
			var waybills = [];

			$(".goods tr").each(function() {
				if ($(this).data("id")) {
					var goodsCd = $(this).data("goods-cd");
					var amount = $(this).data("order-amount");
					var confirmAmount = parseInt($(this).find(".confirm-amount").text());

					items.push({
						id: $(this).data("id"),
						goodsCd: goodsCd,
						amount: amount,
						confirmAmount: confirmAmount,
					});
				}
			});

			$(".boxes tr").each(function() {
				if ($(this).data('box-size')) {
					boxes.push({
						size: $(this).data('box-size'),
						quantity: parseInt($(this).find('.quantity').text()),
					});
				}
			});

			$(".waybills tr").each(function() {
				if ($(this).data('waybill')) {
					waybills.push($(this).data('waybill'));
				}

			});

			if (!Shipping.orderInfo) {
				Shipping.showWarning("주문서 바코드를 먼저 스캔하세요.");
				return;
			}

			if (mode == "complete") {
				if ($(".goods tr").not(".confirmed").length) {
					// if (!Shipping.confirmed) {

					$('html, body').animate({
						scrollTop: $(".goods tr").not(".confirmed").eq(0).offset().top - 300
					}, 500);
					Shipping.showWarning("검수 완료되지 않은 상품이 있습니다.");
					return;
				}

				if (boxes.length == 0) {
					Shipping.showWarning("박스 바코드를 스캔하세요.");
					return;
				}

			}

			if (waybills.length == 0) {
				Shipping.showWarning("송장번호가 입력되지 않았습니다.");
				return;
			}

			var data = {
				mode: mode,
				orderNo: Shipping.orderInfo.orderNo,
				items: items,
				boxes: boxes,
				waybills: waybills,
				validator: Shipping.validatorId,
			};

            $.ajax({
                method: "PUT",
                url: "/api/order-shipments/" + $(this).data("id"),
                data: data
            }).done(function( res ) {
                if (res && res.result == "success") {
                    $(".message-box").empty();
                    if (mode == "complete") {
                        $("<p>정상 접수 완료 처리되었습니다.(" + data.orderNo +
                            ")({{ auth()->user()->name }})</p>"
                        ).appendTo(".message-box");
                    } else if (mode == "partial") {
                        $("<p>정상 부분검수 접수 완료 처리되었습니다.(" + data.orderNo +
                            ")({{ auth()->user()->name }})</p>"
                        ).appendTo(".message-box");
                    } else {
                        $("<p>주문 임시저장 처리가 완료되었습니다.</p>").appendTo(".message-box");
                    }
                    $(".modal-completed").fadeIn();

                    Shipping.orderNo = "";

                    setTimeout(function() {
                        $(".modal-completed").fadeOut();

                        printJS({
                            printable: "/api/order-shipments/waybill/" + data.orderNo + "/order-no",
                            type: "pdf",
                            showModal: true,
                            modalMessage: "송장 미리보기 생성 중..."
                        });

                        $(window).on('focus', function() {
                            $(window).off('focus');
                            console.log('focus is back');

                            location.reload();
                        });

                    }, 1000);
                }
            });
		},

		clearTempOrder: function() {
			$.get("/api/orders/" + Shipping.orderInfo.orderNo + "/clear-order", function(data) {
				if (data.result == "success") {
					location.reload();
				}
			});
		},

		getTempOrderCount: function() {
			$.get("/api/order-shipments/pause", function(data) {
				if (data.result == "success") {
					$(".temp-order-count").text(data.count);
				}
			});
		}
	}

	Shipping.init();
</script>
<header>
	<h2 class="logo">센터 출고시스템</h2>
	<div class="field-barcode">
		<input type="text" id="barcode" placeholder="주문서의 바코드를 스캔하세요." />
	</div>
	<div class="validator">
		<strong>검수자 : </strong>
		<span>{{ auth()->user()->name }}</span>
	</div>
</header>
<div class="content-wrap">
	<style>
		.waybill-barcodes {
			text-align: center;
			color: #000;
			background: #eee;
			padding: 5px;
			border-radius: 5px;
			display: none;
		}

		.waybill-barcodes strong {
			display: inline-block;
			background: #fff;
		}

		.waybill-barcodes img {
			width: 400px;
		}
	</style>
	<div class="waybill-barcodes">
		<strong>
			<label>출력완료</label>
			<img src="/api/generate-barcode/100012" />
		</strong>
		<strong>
			<label>재출력</label>
			<img src="/api/generate-barcode/100012100011" />
		</strong>
	</div>
	<div class="memo-wrap" style="background-color:white; color:red; padding:0 20px;">
		<div class="label-memo">메모</div>
		<span class="order-shipments-memo" style="font-weight:700; font-size:2em;"></span>
	</div>
	<table class="list-goods" cellpadding="0" cellspacing="0">
		<tr>
			<th>순서</th>
			<th>이미지</th>
			<th>상품위치</th>
			<th>센터코드</th>
			<th>상품명</th>
			<th>주문수량</th>
			<th>검수수량</th>
			<th>현재고</th>
		</tr>
		<tbody class="goods">
			<tr>
				<td colspan="8" class="placeholder">주문서의 바코드를 스캔하세요.</td>
			</tr>
		</tbody>
	</table>
	<table class="delivery-info" cellspacing="10" style="border-spacing: 10px !important; border-collapse: separate !important;">
		<tr>
			<td width="50%" class="title">
				택배박스
			</td>
			<td class="title">
				송장
			</td>
		</tr>
		<tr>
			<td width="50%">
				<table class="list-box" cellpadding="0" cellspacing="0">
					<tr>
						<th>순서</th>
						<th>박스사이즈</th>
						<th>수량</th>
					</tr>
					<tbody class="boxes">
						<tr class="message">
							<td colspan="3" class="placeholder">박스 바코드를 스캔하세요.</td>
						</tr>
					</tbody>
				</table>
			</td>
			<td>
				<table class="list-waybill" cellpadding="0" cellspacing="0">
					<tr>
						<th>순서</th>
						<th>송장</th>
					</tr>
					<tbody class="waybills">
						<tr class="message">
							<td colspan="2" class="placeholder">송장 바코드를 스캔하세요.</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</table>
</div>
<footer>
	<div class="order-info">
		<strong>주문번호 : </strong>
		<span class="orderNo"></span>
		<strong>주문자 : </strong>
		<span class="orderName"></span>
		<strong>수령자 : </strong>
		<span class="receiverName"></span>
	</div>
	<div class="temp-order">
		미처리 주문건 : <span class="temp-order-count">0</span>
	</div>
</footer>

<div class="modal-warning">
	<div class="message-box-wrap">
		<div class="message-box">
		</div>
	</div>
</div>

<div class="modal-completed">
	<div class="message-box-wrap">
		<div class="message-box">
		</div>
	</div>
</div>

<script type="text/html" id="goods-item">
	<tr data-id="${id}" data-goods-cd="${center_code}" data-barcode="${barcode}" data-order-amount="${amount}">
		<td class="center">${no}</td>
		@{{if list_image != null && list_image != ''}}
		<td class="center"><img src="${list_image}" width="100" /></td>
		@{{else}}
		<td class="center"><img src="/img/no-image.jpg" width="100" /></td>
		@{{/if}}
		<td class="center">${picking_box_number}</td>
		<td class="center">${center_code}</td>
		<td>
			<div>${goods_name}</div>
			<div class="barcodes">
				<img src="/api/generate-barcode/${barcode}" class="goods-barcode" />
				@{{if center_code != null && center_code != ''}}
				<img src="/api/generate-barcode/${barcode}" class="goods-barcode" />
				@{{/if}}
			</div>
		</td>
		<td class="center">${amount}</td>
		<td class="center confirm-amount">${confirmAmount}</td>
		<td class="center inventory">
			@{{if inventory > 0}}
			${inventory}
			@{{else}}
			<span class="red">0</span><br />
			<span class="red">재고없음</span>
			@{{/if}}
		</td>
	</tr>
</script>

<script type="text/html" id="box-item">
	<tr data-box-size="${size}">
		<td class="center">${no}</td>
		<td class="center">${box}</td>
		<td class="quantity center">${quantity}</td>
	</tr>
</script>
<script type="text/html" id="box-message">
	<tr class="message">
		<td colspan="3" class="placeholder">박스 바코드를 스캔하세요.</td>
	</tr>
</script>

<script type="text/html" id="waybill-item">
	<tr data-waybill="${waybill}">
		<td class="center">${no}</td>
		<td class="center">${waybill}</td>
	</tr>
</script>
<script type="text/html" id="waybill-message">
	<tr class="message">
		<td colspan="2" class="placeholder">송장 바코드를 스캔하세요.</td>
	</tr>
</script>


<script type="text/html" id="complete-message">
	<p>주문서의 모든 상품 검수가 완료되었습니다.</p>
	<p>
		검수자 : {{ auth()->user()->name }}<br />
		완료일 : <span class="completed-datetime">${completed}</span>
	</p>
</script>
</x-inspection-layout>
