<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayautoGood extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'SKU코드' => 'string',
            '모델명' => 'string',
            '브랜드' => 'string',
            '제조사' => 'string',
            '원산지' => 'string',
            '상품명' => 'string',
            '홍보문구' => 'string',
            '요약상품명' => 'string',
            '카테고리코드' => 'string',
            '사용자분류명' => 'string',
            '한줄메모' => 'string',
            '시중가' => 'string',
            '원가' => 'string',
            '표준공급가' => 'string',
            '판매가' => 'string',
            '배송방법' => 'string',
            '배송비' => 'string',
            '과세여부' => 'string',
            '판매수량' => 'string',
            '실재고' => 'string',
            '안전재고' => 'string',
            '이미지1URL' => 'string',
            '이미지2URL' => 'string',
            '이미지3URL' => 'string',
            '이미지4URL' => 'string',
            'GIF생성' => 'string',
            '이미지6URL' => 'string',
            '이미지7URL' => 'string',
            '이미지8URL' => 'string',
            '이미지9URL' => 'string',
            '이미지10URL' => 'string',
            '추가정보입력사항' => 'string',
            '옵션타입' => 'string',
            '옵션구분' => 'string',
            '입력형옵션' => 'string',
            '추가구매옵션' => 'string',
            '광고/홍보' => 'string',
            '제조일자' => 'string',
            '유효일자' => 'string',
            '사은품내용' => 'string',
            '인증구분' => 'string',
            '인증정보' => 'string',
            '거래처' => 'string',
        ];
    }
}
