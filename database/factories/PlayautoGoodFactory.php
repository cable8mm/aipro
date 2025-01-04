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
            'id' => fake()->numerify(),
            'SKU코드' => fake()->text(),
            '모델명' => fake()->text(),
            '브랜드' => fake()->text(),
            '제조사' => fake()->text(),
            '원산지' => fake()->text(),
            '상품명' => fake()->text(),
            '홍보문구' => fake()->text(),
            '요약상품명' => fake()->text(),
            '카테고리코드' => fake()->text(),
            '사용자분류명' => fake()->text(),
            '한줄메모' => fake()->text(),
            '시중가' => fake()->text(),
            '원가' => fake()->text(),
            '표준공급가' => fake()->text(),
            '판매가' => fake()->text(),
            '배송방법' => fake()->text(),
            '배송비' => fake()->text(),
            '과세여부' => fake()->text(),
            '판매수량' => fake()->text(),
            '실재고' => fake()->text(),
            '안전재고' => fake()->text(),
            '이미지1URL' => fake()->text(),
            '이미지2URL' => fake()->text(),
            '이미지3URL' => fake()->text(),
            '이미지4URL' => fake()->text(),
            'GIF생성' => fake()->text(),
            '이미지6URL' => fake()->text(),
            '이미지7URL' => fake()->text(),
            '이미지8URL' => fake()->text(),
            '이미지9URL' => fake()->text(),
            '이미지10URL' => fake()->text(),
            '추가정보입력사항' => fake()->text(),
            '옵션타입' => fake()->text(),
            '옵션구분' => fake()->text(),
            '선택옵션' => fake()->paragraph(),
            '입력형옵션' => fake()->text(),
            '추가구매옵션' => fake()->text(),
            'description' => fake()->paragraph(),
            '추가상세설명' => fake()->paragraph(),
            '광고/홍보' => fake()->text(),
            '제조일자' => fake()->text(),
            '유효일자' => fake()->text(),
            '사은품내용' => fake()->text(),
            '키워드' => fake()->paragraph(),
            '인증구분' => fake()->text(),
            '인증정보' => fake()->text(),
            '거래처' => fake()->text(),
        ];
    }
}
