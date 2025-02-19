<?php

namespace App\ArrayObjects;

use App\Exceptions\OptionGoodInvalidArgumentException;
use App\Models\OptionGood;
use App\Models\SetGood;
use Cable8mm\GoodCode\Enums\GoodCodeType;
use Cable8mm\GoodCode\GoodCode;
use Cable8mm\GoodCode\ValueObjects\SetGood as ValueObjectsSetGood;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Throwable;

class OrderShipment implements Arrayable
{
    public Collection $data;

    private array $containers;

    public function __construct(
        Collection $row,
        int $id,
        int $waybillFilePage
    ) {
        $this->data = new Collection([
            'order_sheet_waybill_id' => $id,
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
            'waybillCompany' => $row[40],
            // 송장번호
            'waybillNo' => $row[41],
            // 마스터상품코드
            'goodsCd' => $row[42],
            // 주의메세지
            'memo' => $row[43],
            // 판매자상품코드
            // Auction combines the product and option codes in the seller's product code,
            // while some shopping malls, such as Lotte iMall, Lotte Department Store, and Cafe24 (new),
            // do not require a separate seller's product code.
            'sellerGoodsCd' => empty($row[44])
                ? $row[42]
                : ($row[44] != $row[42] ? $row[42] : $row[44]),
            // 운송장 파일 페이지 번호
            'waybillFilePage' => $waybillFilePage,
        ]);

        /**
         * For option products, retrieve the sku of the option and update it.
         */
        if (GoodCodeType::of($this->data->get('sellerGoodsCd')) == GoodCodeType::OPTION) {
            $code = GoodCode::of(
                $this->data->get('sellerGoodsCd'),
                option: $this->data->get('option'),
                callback: function ($key, $option) {
                    try {
                        $optionGoodOption = OptionGood::findSku($key)->option($option)->first();
                    } catch (Throwable $e) {
                        throw new OptionGoodInvalidArgumentException(__('OptionGood not found for :key => :option', ['option' => $option, 'key' => $key]), $this);
                    }

                    return $optionGoodOption->sku();
                }
            )->code();

            $this->data->put('goodsCd', $code);
        }

        /**
         * For composite and gift products, retrieve the set product and update the sku.
         */
        if (
            GoodCodeType::of($this->data->get('sellerGoodsCd')) == GoodCodeType::COMPLEX
            || GoodCodeType::of($this->data->get('sellerGoodsCd')) == GoodCodeType::GIFT
        ) {
            $code = GoodCode::of(
                $this->data->get('sellerGoodsCd'),
                callback: function ($key) {
                    return SetGood::findComCode($key)->sku;
                }
            )->code();

            $this->data->put('goodsCd', $code);
        }

        /**
         * If the sku is a set good, copy it as multiple individual goods.
         */
        if (GoodCodeType::of($this->data->get('goodsCd')) == GoodCodeType::SET) {
            $goods = ValueObjectsSetGood::of($this->data->get('goodsCd'))->goods();

            $i = 0;
            foreach ($goods as $code => $quantity) {
                if ($i++ != 0) {
                    $this->data->put('costPrice', 0);
                    $this->data->put('fixedPrice', 0);
                    $this->data->put('totalPrice', 0);
                    $this->data->put('deliveryPrice', 0);
                    $this->data->put('totalDeliveryPrice', 0);
                }
                $this->data->put('amount', $this->data->get('amount') * $quantity);
                $this->data->put('totalAmount', $this->data->get('totalAmount') * $quantity);
                $this->data->put('goodsCd', $code);

                $this->containers[] = $this->data->toArray();
            }
        } else {
            $this->containers[] = $this->data->toArray();
        }
    }

    public function toArray(): array
    {
        return $this->containers;
    }

    public static function of(Collection $row, int $id, int $waybillFilePage): static
    {
        return new static($row, $id, $waybillFilePage);
    }
}
