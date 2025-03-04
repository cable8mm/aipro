<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\EasyLink;
use App\Nova\Metrics\GoodPerDay;
use App\Nova\Metrics\OrderShipmentPerDay;
use App\Nova\Metrics\PurchaseOrderGoodPerDay;
use App\Nova\Metrics\SaleCountPerDay;
use App\Nova\Metrics\SalePricePerDay;
use App\Nova\Metrics\SalePricePerSite;
use App\Nova\Metrics\TotalGood;
use App\Nova\Metrics\TotalOrderShipment;
use App\Nova\Metrics\TotalPurchaseOrderGood;
use App\Nova\Metrics\TotalSaleCount;
use App\Nova\Metrics\TotalSalePrice;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array<int, \Laravel\Nova\Card>
     */
    public function cards(): array
    {
        return [
            new EasyLink,
            new TotalGood,
            new GoodPerDay,
            new TotalOrderShipment,
            new OrderShipmentPerDay,
            new TotalPurchaseOrderGood,
            new PurchaseOrderGoodPerDay,
            new TotalSalePrice,
            new SalePricePerDay,
            new TotalSaleCount,
            new SaleCountPerDay,
            new SalePricePerSite,
        ];
    }

    public function label(): string
    {
        return __('Main');
    }

    public function name(): string
    {
        return __('Order Shipment Per Day');
    }
}
