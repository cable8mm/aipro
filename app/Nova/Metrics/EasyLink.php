<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Metrics\MetricTableRow;
use Laravel\Nova\Metrics\Table;

class EasyLink extends Table
{
    /**
     * Calculate the value of the metric.
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return [
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('출고화면')
                ->subtitle('바코드를 이용한 출고 프로그램을 실행하세요.')
                ->actions(function () {
                    return [
                        MenuItem::externalLink('바로가기', '/order_shipments/shipping'),
                    ];
                }),
            MetricTableRow::make()
                ->icon('check-circle')
                ->iconClass('text-green-500')
                ->title('주문 엑셀/PDF 업로드')
                ->subtitle('플레이오토에서 받은 주문서 엑셀을 업로드 하세요.')
                ->actions(function () {
                    return [
                        MenuItem::externalLink('바로가기', '/nova/resources/order-sheet-invoices/new'),
                    ];
                }),
        ];
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return \DateTimeInterface|\DateInterval|float|int|null
     */
    public function cacheFor()
    {
        return now()->addMinutes(5);
    }

    public function name()
    {
        return '빠른 링크';
    }
}
