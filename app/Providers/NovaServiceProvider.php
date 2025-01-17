<?php

namespace App\Providers;

use App\Nova\AlertEmail;
use App\Nova\Box;
use App\Nova\BoxInventoryHistory;
use App\Nova\BoxManualWarehousing;
use App\Nova\BoxOrder;
use App\Nova\BoxSupplier;
use App\Nova\Channel;
use App\Nova\ChannelFee;
use App\Nova\Dashboards\Main;
use App\Nova\Good;
use App\Nova\GoodInventorySnapshot;
use App\Nova\GoodManualWarehousing;
use App\Nova\HelpTip;
use App\Nova\InventoryHistory;
use App\Nova\MismatchedOrderShipment;
use App\Nova\NaverCategory;
use App\Nova\OptionGood;
use App\Nova\OptionGoodOption;
use App\Nova\Order;
use App\Nova\OrderSheetInvoice;
use App\Nova\OrderShipment;
use App\Nova\PlacingOrder;
use App\Nova\PlacingOrderGood;
use App\Nova\PlayautoCategory;
use App\Nova\PlayautoGood;
use App\Nova\PriceCoefficient;
use App\Nova\PromotionCode;
use App\Nova\RegisterGoodRequest;
use App\Nova\RegisterOptionGoodRequest;
use App\Nova\SetGood;
use App\Nova\Setting;
use App\Nova\ShutdownGood;
use App\Nova\Supplier;
use App\Nova\SupplierGood;
use App\Nova\SupplierGoodManualWarehousing;
use App\Nova\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::userTimezone(function (Request $request) {
            return $request->user()?->timezone;
        });

        Nova::withBreadcrumbs();

        Nova::footer(function ($request) {
            return Blade::render('
                <p class="text-center">&copy; {{ date(\'Y\') }} AI Pro · by Sam Gu Lee</p>
                ');
        });

        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('chart-bar'),

                MenuSection::make('상품/박스 관리', [
                    MenuItem::resource(Good::class),
                    MenuItem::resource(Box::class),
                    MenuItem::resource(RegisterGoodRequest::class),
                ])->icon('cake')->collapsable(),

                MenuSection::make('주문 관리(주문서+출고)', [
                    MenuItem::resource(OrderSheetInvoice::class),
                    MenuItem::resource(Order::class),
                    MenuItem::resource(OrderShipment::class),
                    MenuItem::resource(MismatchedOrderShipment::class),
                ])->icon('shopping-cart')->collapsable(),

                MenuSection::make('재고 관리(발주+입고)', [
                    MenuItem::resource(PlacingOrder::class),
                    MenuItem::resource(BoxOrder::class),
                    MenuItem::resource(GoodManualWarehousing::class),
                    MenuItem::resource(BoxManualWarehousing::class),
                    MenuItem::resource(PlacingOrderGood::class),
                ])->icon('cube')->collapsable(),

                MenuSection::make('공급사/상품 관리', [
                    MenuItem::resource(SupplierGood::class),
                    MenuItem::resource(Supplier::class),
                    MenuItem::resource(BoxSupplier::class),
                    MenuItem::resource(SupplierGoodManualWarehousing::class),
                ])->icon('save')->collapsable(),

                MenuSection::make('통계와 모니터링', [
                    MenuItem::resource(InventoryHistory::class),
                    MenuItem::resource(BoxInventoryHistory::class),
                ])->icon('eye')->collapsable(),

                MenuSection::make(__('MD'), [
                    MenuItem::resource(Good::class),
                    MenuItem::resource(SetGood::class),
                    MenuItem::resource(OptionGood::class),
                    MenuItem::resource(OptionGoodOption::class),
                    MenuItem::resource(PromotionCode::class),
                    MenuItem::resource(RegisterOptionGoodRequest::class),
                    MenuItem::resource(ChannelFee::class),
                ])->icon('shopping-cart')->collapsable(),

                MenuSection::make(__('Playauto'), [
                    MenuItem::resource(Channel::class),
                    MenuItem::resource(PlayautoGood::class),
                    MenuItem::resource(GoodInventorySnapshot::class),
                ])->icon('shopping-cart')->collapsable(),

                MenuSection::make(__('Tools'), [
                    MenuItem::resource(NaverCategory::class),
                    MenuItem::resource(PriceCoefficient::class),
                    MenuItem::resource(ShutdownGood::class),
                ])->icon('shopping-cart')->collapsable(),

                MenuSection::make(__('Setting'), [
                    MenuItem::resource(User::class),
                    MenuItem::resource(Setting::class),
                    MenuItem::resource(AlertEmail::class),
                    MenuItem::resource(PlayautoCategory::class),
                    MenuItem::resource(HelpTip::class),
                ])->icon('cog')->collapsable(),
            ];
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        // Gate::define('viewNova', function ($user) {
        //     return in_array($user->email, [
        //         //
        //     ]);
        // });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
