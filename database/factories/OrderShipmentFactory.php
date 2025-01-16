<?php

namespace Database\Factories;

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
            'orderNo' => fake()->text(255),
            'site' => fake()->text(255),
            'registDate' => fake()->text(255),
            'orderDate' => fake()->text(255),
            'paymentDate' => fake()->text(255),
            'statusDate' => fake()->text(255),
            'deliveryDate' => fake()->text(255),
            'status' => fake()->text(255),
            'siteOrderNo' => fake()->text(255),
            'siteGoodsCd' => fake()->text(255),
            'goodsNm' => fake()->text(255),
            'option' => fake()->text(255),
            'optionPrice' => fake()->randomNumber(),
            'additionalOption' => fake()->text(255),
            'additionalOptionPrice' => fake()->randomNumber(),
            'costPrice' => fake()->randomNumber(),
            'fixedPrice' => fake()->randomNumber(),
            'totalPrice' => fake()->randomNumber(),
            'amount' => fake()->randomNumber(),
            'totalAmount' => fake()->randomNumber(),
            'confirmAmount' => fake()->randomNumber(),
            'deliveryType' => fake()->text(255),
            'deliveryPrice' => fake()->randomNumber(),
            'totalDeliveryPrice' => fake()->randomNumber(),
            'orderName' => fake()->text(255),
            'orderPhone' => fake()->text(255),
            'orderCellPhone' => fake()->text(255),
            'receiverName' => fake()->text(255),
            'receiverPhone' => fake()->text(255),
            'receiverCellPhone' => fake()->text(255),
            'postcode' => fake()->text(255),
            'address' => fake()->text(255),
            'deliveryMemo' => fake()->paragraph(),
            'invoiceCompany' => fake()->text(255),
            'invoiceNo' => fake()->text(255),
            'invoiceFilePath' => fake()->text(255),
            'invoiceFilePage' => fake()->randomNumber(),
            'invoiceGoodsCd' => fake()->text(255),
            'payGoodsCd' => fake()->text(190),
            'masterGoodsCd' => fake()->text(255),
            'memo' => fake()->paragraph(),
            'validator' => fake()->randomNumber(),
            'isSet' => fake()->text(1),
            'printed' => fake()->text(1),
            'downloaded' => fake()->text(1),
            'shipped' => fake()->text(1),
            'boxes' => fake()->text(255),
            'shippable' => fake()->text(1),
            'inventory' => fake()->randomNumber(),
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
            'printed_at' => fake()->dateTime(),
            'downloaded_at' => fake()->dateTime(),
            'shipped_at' => fake()->dateTime(),
            'completed_at' => fake()->dateTime(),
        ];
    }
}
