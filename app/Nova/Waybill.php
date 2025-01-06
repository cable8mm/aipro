<?php

namespace App\Nova;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Waybill extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Waybill>
     */
    public static $model = \App\Models\Waybill::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'Waybills';

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
            Text::make('N_o')->maxlength(190),
            Text::make('Waybill Number')->maxlength(190),
            Text::make('송하인')->maxlength(255),
            Text::make('받는분')->maxlength(255),
            Text::make('전화번호')->maxlength(255),
            Text::make('휴대번호')->maxlength(255),
            Text::make('주소'),
            Text::make('현재상태')->maxlength(255),
            Text::make('최종상품점소')->maxlength(255),
            Text::make('처리시간')->maxlength(255),
            Text::make('접수일자')->maxlength(255),
            Text::make('집화일자')->maxlength(255),
            Text::make('배달일')->maxlength(255),
            Text::make('인수자')->maxlength(255),
            Text::make('집화상위점소')->maxlength(255),
            Text::make('집화점소')->maxlength(255),
            Text::make('배달상위점소')->maxlength(255),
            Text::make('배달점소')->maxlength(255),
            Text::make('주문번호')->maxlength(255),
            Text::make('품명')->maxlength(255),
            Text::make('운임구분')->maxlength(255),
            Text::make('박스타입')->maxlength(255),
            Text::make('수량')->maxlength(255),
            Text::make('금액')->maxlength(255),
            Text::make('접수구분')->maxlength(255),
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
}
