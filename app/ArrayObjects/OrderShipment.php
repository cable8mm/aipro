<?php

namespace App\ArrayObjects;

use App\Models\OptionGood;
use App\Models\SetGood;
use Cable8mm\GoodCode\Enums\GoodCodeType;
use Cable8mm\GoodCode\GoodCode;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class OrderShipment implements Arrayable
{
    public Collection $data;

    private array $containers;

    public function __construct(
        Collection $row,
        int $id
    ) {
        $this->data = new Collection([
            'order_sheet_invoice_id' => $id,
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
            'orderName' => $row[31],
            // 구매자전화번호
            'orderPhone' => $row[32],
            // 구매자휴대폰번호
            'orderCellPhone' => $row[33],
            // 수령자명
            'receiverName' => $row[34],
            // 수령자전화번호
            'receiverPhone' => $row[35],
            // 수령자휴대폰번호
            'receiverCellPhone' => $row[36],
            // 배송지우편번호
            'postcode' => $row[37],
            // 배송지주소
            'address' => $row[38],
            // 배송메세지
            'deliveryMemo' => $row[39],
            // 배송사명
            'invoiceCompany' => $row[40],
            // 송장번호
            'invoiceNo' => $row[41],
            // 마스터상품코드
            'masterGoodsCd' => $row[42],
            // 주의메세지
            'memo' => $row[43],
            // 판매자상품코드
            // 옥션은 판매자상품코드에 상품과 옵션코드를 합치며, 롯데아이몰과 롯데백화점, 카페24(신) 등 몇개의 쇼핑몰은 판매자상품코드를 별도로 입력하지 않는다.
            'sellerGoodsCd' => empty($row[44])
                ? $row[42]
                : ($row[44] != $row[42] ? $row[42] : $row[44]),
        ]);

        /**
         * 옵션상품일 경우 옵션의 master_code를 구해서 업데이트 합니다.
         */
        if (GoodCodeType::of($this->data->get('sellerGoodsCd')) == GoodCodeType::OPTION) {
            $code = GoodCode::of(
                $this->data->get('sellerGoodsCd'),
                option: $this->data->get('option'),
                callback: function ($key, $option) {
                    return OptionGood::findMasterCode($key)->option($option)->first()->masterCode();
                }
            )->code();

            $this->data->put('masterGoodsCd', $code);
        }

        if (
            GoodCodeType::of($this->data->get('sellerGoodsCd')) == GoodCodeType::COMPLEX
            || GoodCodeType::of($this->data->get('sellerGoodsCd')) == GoodCodeType::GIFT
        ) {
            $code = GoodCode::of(
                $this->data->get('sellerGoodsCd'),
                callback: function ($key) {
                    return SetGood::findComCode($key)->master_code;
                }
            )->code();

            $this->data->put('masterGoodsCd', $code);
        }

        $this->containers[] = $this->data->toArray();
    }

    public function toArray(): array
    {
        return $this->containers;
    }
}
