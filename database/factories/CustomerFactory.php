<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
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
            'author_id' => fake()->randomNumber(1) + 1,
            'name' => fake()->company(),
            'contact_name' => fake()->name(),
            'contact_email' => fake()->localAreaPhoneNumber(),
            'contact_tel' => fake()->localAreaPhoneNumber(),
            'contact_cel' => fake()->cellPhoneNumber(),
            'balance_criteria' => fake()->randomElement(self::$balanceCriteria),
            'additional_information' => fake()->paragraph(),
            'is_active' => fake()->boolean(),
        ];
    }
}
