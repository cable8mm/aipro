<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class PlayautoGood extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PlayautoGood>
     */
    public static $model = \App\Models\PlayautoGood::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'SKU코드';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('SKU코드', 'SKU코드')->maxlength(255),
            Text::make('모델명')->maxlength(255),
            Text::make('브랜드')->maxlength(255),
            Text::make('제조사')->maxlength(255),
            Text::make('원산지')->maxlength(255),
            Text::make('상품명')->maxlength(255),
            Text::make('홍보문구')->maxlength(255),
            Text::make('요약상품명')->maxlength(255),
            Text::make('카테고리코드')->maxlength(255),
            Text::make('사용자분류명')->maxlength(255),
            Text::make('한줄메모')->maxlength(255),
            Text::make('시중가')->maxlength(255),
            Text::make('원가')->maxlength(255),
            Text::make('표준공급가')->maxlength(255),
            Text::make('판매가')->maxlength(255),
            Text::make('배송방법')->maxlength(255),
            Text::make('배송비')->maxlength(255),
            Text::make('과세여부')->maxlength(255),
            Text::make('판매수량')->maxlength(255),
            Text::make('실재고')->maxlength(255),
            Text::make('안전재고')->maxlength(255),
            Text::make('이미지1URL')->maxlength(255),
            Text::make('이미지2URL')->maxlength(255),
            Text::make('이미지3URL')->maxlength(255),
            Text::make('이미지4URL')->maxlength(255),
            Text::make('GIF생성')->maxlength(255),
            Text::make('이미지6URL')->maxlength(255),
            Text::make('이미지7URL')->maxlength(255),
            Text::make('이미지8URL')->maxlength(255),
            Text::make('이미지9URL')->maxlength(255),
            Text::make('이미지10URL')->maxlength(255),
            Text::make('추가정보입력사항')->maxlength(255),
            Text::make('옵션타입')->maxlength(255),
            Text::make('옵션구분')->maxlength(255),
            Text::make('선택옵션'),
            Text::make('입력형옵션')->maxlength(255),
            Text::make('추가구매옵션')->maxlength(255),
            Textarea::make('Description'),
            Text::make('추가상세설명'),
            Text::make('광고/홍보')->maxlength(255),
            Text::make('제조일자')->maxlength(255),
            Text::make('유효일자')->maxlength(255),
            Text::make('사은품내용')->maxlength(255),
            Text::make('키워드'),
            Text::make('인증구분')->maxlength(255),
            Text::make('인증정보')->maxlength(255),
            Text::make('거래처')->maxlength(255),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    public static function label()
    {
        return __('Playauto Goods');
    }
}
