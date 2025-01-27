<?php

namespace App\Providers;

use App\Models\AlertEmail as ModelsAlertEmail;
use App\Models\BarcodeCommand as ModelsBarcodeCommand;
use App\Models\Box as ModelsBox;
use App\Models\BoxSupplier as ModelsBoxSupplier;
use App\Models\Good as ModelsGood;
use App\Models\HelpTip as ModelsHelpTip;
use App\Models\OptionGood as ModelsOptionGood;
use App\Models\OptionGoodOption as ModelsOptionGoodOption;
use App\Models\PickingZone as ModelsPickingZone;
use App\Models\PromotionCode as ModelsPromotionCode;
use App\Models\SetGood as ModelsSetGood;
use App\Models\Setting as ModelsSetting;
use App\Models\Supplier as ModelsSupplier;
use App\Models\User as ModelsUser;
use App\Nova\AlertEmail;
use App\Nova\BarcodeCommand;
use App\Nova\BasicGood;
use App\Nova\Box;
use App\Nova\BoxInventoryHistory;
use App\Nova\BoxManualWarehousing;
use App\Nova\BoxPlacingOrder;
use App\Nova\BoxSupplier;
use App\Nova\Dashboards\Main;
use App\Nova\Good;
use App\Nova\GoodManualWarehousing;
use App\Nova\HelpfulFile;
use App\Nova\HelpTip;
use App\Nova\InventoryHistory;
use App\Nova\MismatchedOrderShipment;
use App\Nova\OptionGood;
use App\Nova\OptionGoodOption;
use App\Nova\Order;
use App\Nova\OrderSheetInvoice;
use App\Nova\OrderShipment;
use App\Nova\PickingZone;
use App\Nova\PlacingOrder;
use App\Nova\PlacingOrderBox;
use App\Nova\PlacingOrderGood;
use App\Nova\PromotionCode;
use App\Nova\RegisterGoodRequest;
use App\Nova\RegisterOptionGoodRequest;
use App\Nova\SetGood;
use App\Nova\Setting;
use App\Nova\Supplier;
use App\Nova\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\Menu;
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

        Nova::withoutNotificationCenter();

        Nova::footer(function ($request) {
            return Blade::render('
                <p class="text-center">&copy; {{ date(\'Y\') }} AI Pro · by Sam Gu Lee</p>
                ');
        });

        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('home'),

                MenuSection::make('상품/박스 관리', [
                    MenuItem::resource(Good::class)->withBadge(fn () => ModelsGood::count(), 'info'),
                    MenuItem::resource(Box::class)->withBadge(fn () => ModelsBox::count(), 'info'),
                    MenuItem::resource(RegisterGoodRequest::class),
                ])->icon('truck')->collapsable(),

                MenuSection::make('주문 관리(주문서+출고)', [
                    MenuItem::resource(OrderSheetInvoice::class),
                    MenuItem::resource(Order::class),
                    MenuItem::resource(OrderShipment::class),
                    MenuItem::resource(MismatchedOrderShipment::class),
                ])->icon('archive')->collapsable(),

                MenuSection::make('재고 관리(발주+입고)', [
                    MenuItem::resource(PlacingOrder::class),
                    MenuItem::resource(BoxPlacingOrder::class),
                    MenuItem::resource(GoodManualWarehousing::class),
                    MenuItem::resource(BoxManualWarehousing::class),
                    MenuItem::resource(PlacingOrderGood::class),
                    MenuItem::resource(PlacingOrderBox::class),
                ])->icon('cube')->collapsable(),

                MenuSection::make('공급사/상품 관리', [
                    MenuItem::resource(Supplier::class)->withBadge(fn () => ModelsSupplier::count(), 'info'),
                    MenuItem::resource(BoxSupplier::class)->withBadge(fn () => ModelsBoxSupplier::count(), 'info'),
                ])->icon('inbox-in')->collapsable(),

                MenuSection::make('통계와 모니터링', [
                    MenuItem::resource(InventoryHistory::class),
                    MenuItem::resource(BoxInventoryHistory::class),
                ])->icon('eye')->collapsable(),

                MenuSection::make(__('MD'), [
                    MenuItem::resource(BasicGood::class)->withBadge(fn () => ModelsGood::count(), 'info'),
                    MenuItem::resource(SetGood::class)->withBadge(fn () => ModelsSetGood::count(), 'info'),
                    MenuItem::resource(OptionGood::class)->withBadge(fn () => ModelsOptionGood::count(), 'info'),
                    MenuItem::resource(OptionGoodOption::class)->withBadge(fn () => ModelsOptionGoodOption::count(), 'info'),
                    MenuItem::resource(PromotionCode::class)->withBadge(fn () => ModelsPromotionCode::count(), 'info'),
                    MenuItem::resource(RegisterOptionGoodRequest::class),
                ])->icon('shopping-cart')->collapsable(),

                MenuSection::make(__('Tools'), [
                    MenuItem::resource(BarcodeCommand::class)->withBadge(fn () => ModelsBarcodeCommand::count(), 'info'),
                    MenuItem::externalLink(__('Print Barcode Commands'), '/barcode-command')->openInNewTab(),
                    MenuItem::resource(HelpfulFile::class),
                ])->icon('scissors')->collapsable(),

                MenuSection::make(__('Services'), [
                    MenuItem::resource(AlertEmail::class)->withBadge(fn () => ModelsAlertEmail::count(), 'info'),
                    MenuItem::resource(HelpTip::class)->withBadge(fn () => ModelsHelpTip::count(), 'info'),
                ])->icon('sparkles')->collapsable(),

                MenuSection::make(__('Setting'), [
                    MenuItem::resource(User::class)->withBadge(fn () => ModelsUser::count(), 'info'),
                    MenuItem::resource(Setting::class)->withBadge(fn () => ModelsSetting::count(), 'info'),
                    MenuItem::resource(PickingZone::class)->withBadge(fn () => ModelsPickingZone::count(), 'info'),
                ])->icon('cog')->collapsable(),

                MenuSection::make(__('Helpful Links'), [
                    MenuItem::externalLink(__('GitHub'), 'https://github.com/cable8mm/aipro')->openInNewTab(),
                ])->icon('external-link')->collapsable(),
            ];
        });

        /**
         * @see https://nova.laravel.com/docs/v4/customization/menus#appending-prepending-to-the-menu
         */
        Nova::userMenu(function (Request $request, Menu $menu) {
            return $menu
                ->prepend(MenuItem::link(__('My Profile'), '/resources/users/'.$request->user()->getKey()));
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
