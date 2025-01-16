<?php

namespace Database\Factories;

use App\Enums\OrderMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SupplierFactory extends Factory
{
    public static array $balanceCriteria = [
        '',
        '익월 10일',
        '선결제',
        '선결제: 발주-->계산서발행-->입금-->출고',
        '상품입고 확인 후 결제 (선결제)',
        '입고후,선결제(초도), 이후 익월10일',
        '첫발주 선결제, 익월 10일정산',
        '익월 10일 / 챠오추르',
        '선결제 / 벨포아',
        '첫결제 선결, 이후 익월 10일 / 미아모아.카토빗.런치',
        '첫결제 선결 , 이후 익월10일. 트루라인',
        '익월10일, 선결제',
        '첫결제선결제/익월10일',
        '첫거래 선결제, 이후 결제 익월 10일',
        '입고후  5일이내',
        '첫거래 선입금, 이후 익월 10일 ',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake('ko_KR')->company(),
            'ordered_email' => fake()->email(),
            'contact_name' => fake('ko_KR')->name(),
            'contact_tel' => fake('ko_KR')->localAreaPhoneNumber(),
            'contact_cel' => fake('ko_KR')->cellPhoneNumber(),
            'order_method' => fake()->randomElements(OrderMethod::names(), fake()->numberBetween(0, count(OrderMethod::names()) - 1)),
            'balance_criteria' => fake()->randomElement(self::$balanceCriteria),
            'min_order_price' => fake()->randomElement([0, 100000, 200000, 500000, 1000000, 2000000]),
            'additional_information' => fake()->paragraph(),
            'is_parceled' => fake()->boolean(),
            'is_active' => fake()->boolean(),
        ];
    }
}
