<?php

namespace Database\Factories;

use App\Enums\OrderShipmentDeliveryType;
use App\Enums\OrderShipmentStatus;
use App\Enums\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        fake()->addProvider(new \Bezhanov\Faker\Provider\Commerce(fake()));
        fake()->addProvider(new \Bezhanov\Faker\Provider\Device(fake()));

        return [
            'order_sheet_waybill_id' => fake()->randomNumber(1) + 1,
            'orderNo' => (string) fake()->randomNumber(9, true),
            'site' => fake()->randomElement(Site::keys()),
            'registDate' => fake()->dateTime(),
            'orderDate' => fake()->dateTime(),
            'paymentDate' => fake()->dateTime(),
            'statusDate' => fake()->dateTime(),
            'deliveryDate' => fake()->dateTime(),
            'status' => fake()->randomElement(OrderShipmentStatus::keys()),
            'siteOrderNo' => fake()->randomNumber(9) + 1,
            'siteGoodsCd' => fake()->randomNumber(4) + 1,
            'goodsNm' => fake()->productName(),
            'option' => fake()->randomElement([null, 'Large', 'Small', 'Medium']),
            'optionPrice' => fake()->randomNumber(5) + 1,
            'additionalOption' => fake()->randomElement([null, 'Red', 'Yellow', 'Black', 'White']),
            'additionalOptionPrice' => fake()->randomNumber(5, true) + 1,
            'costPrice' => fake()->randomNumber(5) + 1,
            'fixedPrice' => fake()->randomNumber(5) + 1,
            'totalPrice' => fake()->randomNumber(5) + 1,
            'amount' => fake()->randomNumber(2) + 1,
            'totalAmount' => fake()->randomNumber(6, true),
            'confirmAmount' => fake()->randomNumber(6, true),
            'deliveryType' => fake()->randomElement(OrderShipmentDeliveryType::keys()),
            'deliveryPrice' => fake()->randomElement([0, 3000, 5000, 7000]),
            'totalDeliveryPrice' => fake()->randomElement([0, 3000, 5000, 7000]),
            'orderName' => fake()->name(),
            'orderPhone' => fake()->phoneNumber(),
            'orderCellPhone' => fake('ko_KR')->cellPhoneNumber(),
            'receiverName' => fake()->name(),
            'receiverPhone' => fake()->phoneNumber(),
            'receiverCellPhone' => fake('ko_KR')->cellPhoneNumber(),
            'postcode' => fake()->postcode(),
            'address' => fake()->address(),
            'deliveryMemo' => fake()->randomElement(['문 앞에 놔 주세요', '', '부재 시 연락 주세요']),
            'waybillCompany' => fake()->company(),
            'waybillNo' => fake()->randomNumber(9) + 1,
            'waybillFilePath' => fake()->uuid().'.pdf',
            'waybillFilePage' => fake()->randomNumber(),
            'waybillGoodsCd' => fake()->randomNumber(7) + 1,
            'payGoodsCd' => fake()->randomNumber(9) + 1,
            'goodsCd' => fake()->randomNumber(9) + 1,
            'sellerGoodsCd' => fake()->randomNumber(9) + 1,
            'memo' => '',
            'validator' => fake()->randomNumber(1) + 1,
            'isSet' => fake()->randomElement([0, 1]),
            'printed' => fake()->randomElement([0, 1]),
            'downloaded' => fake()->randomElement([0, 1]),
            'shipped' => fake()->randomElement([0, 1]),
            'boxes' => '',
            'shippable' => fake()->randomElement(['Y', 'N']),
            'inventory' => fake()->randomNumber(3) + 1,
            'printed_at' => fake()->dateTime(),
            'downloaded_at' => fake()->dateTime(),
            'shipped_at' => fake()->dateTime(),
            'completed_at' => fake()->dateTime(),
        ];
    }
}
