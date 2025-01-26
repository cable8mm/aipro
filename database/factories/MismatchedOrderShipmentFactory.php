<?php

namespace Database\Factories;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MismatchedOrderShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $row = 1;
        $sites = [];
        if (($handle = fopen(base_path('tests/files/site.csv'), 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $sites[] = $data[0];
            }
            fclose($handle);
        }

        fake()->addProvider(new \Bezhanov\Faker\Provider\Commerce(fake()));
        fake()->addProvider(new \Bezhanov\Faker\Provider\Device(fake()));

        return [
            'author_id' => (fake()->randomNumber(1) + 1),
            'order_sheet_invoice_id' => (fake()->randomNumber(1) + 1),
            'order_no' => (string) fake()->randomNumber(9, true),
            'site' => fake()->randomElement($sites),
            'master_goods_cd' => 'CODE'.fake()->randomNumber(3, true),
            'goods_nm' => fake()->productName(),
            'option' => fake()->randomElement([null, 'Large', 'Small', 'Medium']),
            'json' => json_decode('{"id":"450018","order_sheet_invoice_id":"230","orderNo":"100119116097","site":"\uc9c1\uc811\uc785\ub825","registDate":"2020-08-24 \uc624\ud6c4 4:49:50","orderDate":"2020-08-20 \uc624\uc804 11:41:16","paymentDate":"2020-08-20 \uc624\uc804 11:34:25","statusDate":"2020-08-24 \uc624\ud6c4 4:50:46","deliveryDate":"0001-01-01 \uc624\uc804 12:00:00","status":"\uc0c1\ud488\uc900\ube44\uc911","siteOrderNo":"20200820-0000092_C5TOW","siteGoodsCd":"80","goodsNm":"\ud2bc\ud2bc\uc9d0\ubcfc \uc14b\uc774\ubb49\uce58\uba74\uc2f8\ub2e4","option":"\uc120\ud0dd=\ud2bc\ud2bc\uc9d0\ubcfc\ud640\ub354\uc138\ud2b8 3\uac1c\ubb36\uc74c","optionPrice":null,"additionalOption":null,"additionalOptionPrice":null,"costPrice":null,"fixedPrice":null,"totalPrice":null,"amount":"1","totalAmount":"1","confirmAmount":null,"deliveryType":"\uc120\uacb0\uc81c","deliveryPrice":null,"totalDeliveryPrice":null,"orderName":"\uae40\uc5ec\ub984","orderPhone":"010-6806-1574","orderCellPhone":"010-6806-1574","receiverName":"\uac15\uc815\ud6c8","receiverPhone":"010-6806-1574","receiverCellPhone":"010-6806-1574","postcode":"49459","address":"\ubd80\uc0b0\uad11\uc5ed\uc2dc \uc0ac\ud558\uad6c \uc11c\ud3ec\ub85c30\ubc88\uae38 12 (\uad6c\ud3c9\ub3d9) \uc774\ud3b8\ud55c\uc138\uc0c12\ucc28 206\ub3d9 901\ud638","deliveryMemo":"\ubd80\uc7ac\uc2dc \ubb38 \uc55e\uc5d0 \ub193\uc544\uc8fc\uc138\uc694","invoiceCompany":"\ud55c\uc9c4\ud0dd\ubc30","invoiceNo":"509245876790","invoiceFilePath":"\/uploads\/20200824_24_1598255484.pdf","invoiceFilePage":"1","masterGoodsCd":"OPT436XE14593","memo":null,"validator":"25","isSet":"N","printed":"N","downloaded":"N","shipped":"N","boxes":null,"shippable":"Y","inventory":null,"created_at":"2020-08-24 16:51:26","updated_at":"2020-08-24 16:51:26","printed_at":null,"downloaded_at":null,"shipped_at":null,"completed_at":null}'),
            'status' => fake()->randomElement(Status::names()),
        ];
    }
}
