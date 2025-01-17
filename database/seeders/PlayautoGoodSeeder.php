<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlayautoGoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (($handle = fopen(base_path('docs/csv/playauto_goods_for_test.csv'), 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                try {
                    \App\Models\PlayautoGood::factory(1, [
                        'id' => $data[0],
                        'SKU코드' => $data[1] ?? '',
                        '모델명' => $data[2] ?? '',
                        '브랜드' => $data[3] ?? '',
                        '제조사' => $data[4] ?? '',
                        '원산지' => $data[5] ?? '',
                        '상품명' => $data[6] ?? '',
                        '홍보문구' => $data[7] ?? '',
                        '요약상품명' => $data[8] ?? '',
                        '카테고리코드' => $data[9] ?? '',
                        '사용자분류명' => $data[10] ?? '',
                        '한줄메모' => $data[11] ?? '',
                        '시중가' => $data[12] ?? '',
                        '원가' => $data[13] ?? '',
                        '표준공급가' => $data[14] ?? '',
                        '판매가' => $data[15] ?? '',
                        '배송방법' => $data[16] ?? '',
                        '배송비' => $data[17] ?? '',
                        '과세여부' => $data[18] ?? '',
                        '판매수량' => $data[19] ?? '',
                        '실재고' => $data[20] ?? '',
                        '안전재고' => $data[21] ?? '',
                        '이미지1URL' => $data[22] ?? '',
                        '이미지2URL' => $data[23] ?? '',
                        '이미지3URL' => $data[24] ?? '',
                        '이미지4URL' => $data[25] ?? '',
                        'GIF생성' => $data[26] ?? '',
                        '이미지6URL' => $data[27] ?? '',
                        '이미지7URL' => $data[28] ?? '',
                        '이미지8URL' => $data[29] ?? '',
                        '이미지9URL' => $data[30] ?? '',
                        '이미지10URL' => $data[31] ?? '',
                        '추가정보입력사항' => $data[32] ?? '',
                        '옵션타입' => $data[33] ?? '',
                        '옵션구분' => $data[34] ?? '',
                        '선택옵션' => $data[35] ?? '',
                        '입력형옵션' => $data[36] ?? '',
                        '추가구매옵션' => $data[37] ?? '',
                        'description' => $data[38] ?? '',
                        '추가상세설명' => $data[39] ?? '',
                        '광고/홍보' => $data[40] ?? '',
                        '제조일자' => $data[41] ?? '',
                        '유효일자' => $data[42] ?? '',
                        '사은품내용' => $data[43] ?? '',
                        '키워드' => $data[44] ?? '',
                        '인증구분' => $data[45] ?? '',
                        '인증정보' => $data[46] ?? '',
                        '거래처' => $data[47] ?? '',
                    ])->create();
                } catch (\Exception $e) {
                }
            }
            fclose($handle);
        }
    }
}
