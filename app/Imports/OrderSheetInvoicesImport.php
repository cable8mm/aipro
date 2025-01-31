<?php

namespace App\Imports;

use App\Models\OrderSheetInvoice;
use App\Models\OrderShipment;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class OrderSheetInvoicesImport implements SkipsEmptyRows, ToModel, WithStartRow
{
    private OrderSheetInvoice $orderSheetInvoice;

    public function __construct(OrderSheetInvoice $orderSheetInvoice)
    {
        $this->orderSheetInvoice = $orderSheetInvoice;
    }

    /**
     * @return OrderSheetInvoice|null
     */
    public function model(array $row)
    {
        return new OrderShipment([
            'order_sheet_invoice_id' => $this->orderSheetInvoice->id,
            // 주문고유번호
            'orderNo' => $row[0],
            // 판매사이트명
            'site' => $row[1],
            // 판매사이트코드
            // 판매자ID
            // 주문수집자ID
            // 수집일
            'registDate' => $row[5],
            // 주문일
            'orderDate' => $row[6],
            // 결제일
            'paymentDate' => $row[7],
            // 상태변경일
            'statusDate' => $row[8],
            // 배송일
            'deliveryDate' => $row[9],
            // 상태
            'status' => $row[10],
            // 판매사이트 주문번호
            'siteOrderNo' => $row[11],
            // 판매사이트 상품코드
            'siteGoodsCd' => $row[12],
            // 상품명
            'goodsNm' => $row[13],
            // 상품명-홍보문구
            // 주문선택사항
            'option' => $row[15],
            // 주문선택사항금액
            'optionPrice' => $row[16],
            // 추가구매옵션
            'additionalOption' => $row[17],
            // 추가구매옵션금액
            'additionalOptionPrice' => $row[18],
            // 원가
            'costPrice' => $row[19],
            // 공급가
            'fixedPrice' => $row[20],
            // 판매가
            'totalPrice' => $row[21],
            // 총판매가(묶음후)
            // 주문수량
            'amount' => $row[23],
            // 총주문수량(묶음후)
            'totalAmount' => $row[24],
            // 배송방법(원본)
            'deliveryType' => $row[25],
            // 배송방법(묶음/조건적용후)
            // 배송방법 자동적용 사유
            // 배송비금액
            'deliveryPrice' => $row[28],
            // 총배송비금액(묶음후)
            'totalDeliveryPrice' => $row[29],
            // 구매자ID
            // 구매자명
            'orderName' => $row[30],
            // 구매자전화번호
            'orderPhone' => $row[31],
            // 구매자휴대폰번호
            'orderCellPhone' => $row[32],
            // 수령자명
            'receiverName' => $row[33],
            // 수령자전화번호
            'receiverPhone' => $row[34],
            // 수령자휴대폰번호
            'receiverCellPhone' => $row[35],
            // 배송지우편번호
            'postcode' => $row[36],
            // 배송지주소
            'address' => $row[37],
            // 배송메세지
            'deliveryMemo' => $row[38],
            // 배송사명
            'invoiceCompany' => $row[39],
            // 송장번호
            'invoiceNo' => $row[40],
            // 마스터상품코드
            'masterGoodsCd' => $row[41],
            // 주의메세지
            'memo' => $row[42],
            // 판매자상품코드
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
