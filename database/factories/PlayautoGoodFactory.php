<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PlayautoGoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'SKU코드' => fake()->text(255),
            '모델명' => fake()->text(255),
            '브랜드' => fake()->text(255),
            '제조사' => fake()->text(255),
            '원산지' => fake()->text(255),
            '상품명' => fake()->text(255),
            '홍보문구' => fake()->text(255),
            '요약상품명' => fake()->text(255),
            '카테고리코드' => fake()->text(255),
            '사용자분류명' => fake()->text(255),
            '한줄메모' => fake()->text(255),
            '시중가' => fake()->text(255),
            '원가' => fake()->text(255),
            '표준공급가' => fake()->text(255),
            '판매가' => fake()->text(255),
            '배송방법' => fake()->text(255),
            '배송비' => fake()->text(255),
            '과세여부' => fake()->text(255),
            '판매수량' => fake()->text(255),
            '실재고' => fake()->text(255),
            '안전재고' => fake()->text(255),
            '이미지1URL' => fake()->text(255),
            '이미지2URL' => fake()->text(255),
            '이미지3URL' => fake()->text(255),
            '이미지4URL' => fake()->text(255),
            'GIF생성' => fake()->text(255),
            '이미지6URL' => fake()->text(255),
            '이미지7URL' => fake()->text(255),
            '이미지8URL' => fake()->text(255),
            '이미지9URL' => fake()->text(255),
            '이미지10URL' => fake()->text(255),
            '추가정보입력사항' => fake()->text(255),
            '옵션타입' => fake()->text(255),
            '옵션구분' => fake()->text(255),
            '선택옵션' => fake()->paragraph(),
            '입력형옵션' => fake()->text(255),
            '추가구매옵션' => fake()->text(255),
            'description' => fake()->paragraph(),
            '추가상세설명' => fake()->paragraph(),
            '광고/홍보' => fake()->text(255),
            '제조일자' => fake()->text(255),
            '유효일자' => fake()->text(255),
            '사은품내용' => fake()->text(255),
            '키워드' => fake()->paragraph(),
            '인증구분' => fake()->text(255),
            '인증정보' => fake()->text(255),
            '거래처' => fake()->text(255),
        ];
    }
}
