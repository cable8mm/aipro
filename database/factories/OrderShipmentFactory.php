<?php

namespace Database\Factories;

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
        return [
            'order_sheet_invoice_id' => fake()->randomNumber(1) + 1,
            'orderNo' => fake()->text(10),
            'site' => fake()->randomElement(Site::names()),
            'registDate' => fake()->dateTime(),
            'orderDate' => fake()->dateTime(),
            'paymentDate' => fake()->dateTime(),
            'statusDate' => fake()->dateTime(),
            'deliveryDate' => fake()->dateTime(),
            'status' => fake()->word(),
            'siteOrderNo' => fake()->randomNumber(9) + 1,
            'siteGoodsCd' => fake()->randomNumber(4) + 1,
            'goodsNm' => fake()->name(),
            'option' => fake()->word(),
            'optionPrice' => fake()->randomNumber(5) + 1,
            'additionalOption' => fake()->word(),
            'additionalOptionPrice' => fake()->randomNumber(5, true) + 1,
            'costPrice' => fake()->randomNumber(5) + 1,
            'fixedPrice' => fake()->randomNumber(5) + 1,
            'totalPrice' => fake()->randomNumber(5) + 1,
            'amount' => fake()->randomNumber(2) + 1,
            'totalAmount' => fake()->randomNumber(6, true),
            'confirmAmount' => fake()->randomNumber(6, true),
            'deliveryType' => fake()->word(),
            'deliveryPrice' => fake()->randomNumber(4) + 1,
            'totalDeliveryPrice' => fake()->randomNumber(4) + 1,
            'orderName' => fake('ko_KR')->name(),
            'orderPhone' => fake('ko_KR')->phoneNumber(),
            'orderCellPhone' => fake('ko_KR')->cellPhoneNumber(),
            'receiverName' => fake('ko_KR')->name(),
            'receiverPhone' => fake('ko_KR')->phoneNumber(),
            'receiverCellPhone' => fake('ko_KR')->cellPhoneNumber(),
            'postcode' => fake('ko_KR')->postcode(),
            'address' => fake('ko_KR')->address(),
            'deliveryMemo' => fake()->paragraph(),
            'invoiceCompany' => fake()->company(),
            'invoiceNo' => fake()->randomNumber(9) + 1,
            'invoiceFilePath' => fake()->uuid().'.'.fake()->fileExtension(),
            'invoiceFilePage' => fake()->randomNumber(),
            'invoiceGoodsCd' => fake()->randomNumber(7) + 1,
            'payGoodsCd' => fake()->randomNumber(9) + 1,
            'masterGoodsCd' => fake()->randomNumber(9) + 1,
            'memo' => fake()->paragraph(),
            'validator' => fake()->randomNumber(),
            'isSet' => fake()->randomElement([0, 1]),
            'printed' => fake()->randomElement([0, 1]),
            'downloaded' => fake()->randomElement([0, 1]),
            'shipped' => fake()->randomElement([0, 1]),
            'boxes' => fake()->text(255),
            'shippable' => fake()->randomElement(['Y', 'N']),
            'inventory' => fake()->randomNumber(9) + 1,
            'printed_at' => fake()->dateTime(),
            'downloaded_at' => fake()->dateTime(),
            'shipped_at' => fake()->dateTime(),
            'completed_at' => fake()->dateTime(),
        ];
    }
}
