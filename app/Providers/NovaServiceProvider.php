<?php

namespace App\Providers;

use App\Models\AlertEmail as ModelsAlertEmail;
use App\Models\Box as ModelsBox;
use App\Models\BoxSupplier as ModelsBoxSupplier;
use App\Models\Channel as ModelsChannel;
use App\Models\Good as ModelsGood;
use App\Models\HelpTip as ModelsHelpTip;
use App\Models\NaverCategory as ModelsNaverCategory;
use App\Models\OptionGood as ModelsOptionGood;
use App\Models\OptionGoodOption as ModelsOptionGoodOption;
use App\Models\PlayautoCategory as ModelsPlayautoCategory;
use App\Models\PlayautoGood as ModelsPlayautoGood;
use App\Models\PromotionCode as ModelsPromotionCode;
use App\Models\SetGood as ModelsSetGood;
use App\Models\Setting as ModelsSetting;
use App\Models\ShutdownGood as ModelsShutdownGood;
use App\Models\Supplier as ModelsSupplier;
use App\Models\SupplierGood as ModelsSupplierGood;
use App\Models\User as ModelsUser;
use App\Nova\AlertEmail;
use App\Nova\BasicGood;
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
use App\Nova\ManagedGood;
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

        Nova::showUnreadCountInNotificationCenter();

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
                    MenuItem::resource(BoxOrder::class),
                    MenuItem::resource(GoodManualWarehousing::class),
                    MenuItem::resource(BoxManualWarehousing::class),
                    MenuItem::resource(PlacingOrderGood::class),
                ])->icon('cube')->collapsable(),

                MenuSection::make('공급사/상품 관리', [
                    MenuItem::resource(SupplierGood::class)->withBadge(fn () => ModelsSupplierGood::count(), 'info'),
                    MenuItem::resource(Supplier::class)->withBadge(fn () => ModelsSupplier::count(), 'info'),
                    MenuItem::resource(BoxSupplier::class)->withBadge(fn () => ModelsBoxSupplier::count(), 'info'),
                    MenuItem::resource(SupplierGoodManualWarehousing::class),
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
                    MenuItem::resource(ChannelFee::class),
                ])->icon('shopping-cart')->collapsable(),

                MenuSection::make(__('SCM'), [
                    MenuItem::resource(ManagedGood::class)->withBadge(fn () => ModelsGood::count(), 'info'),
                ])->icon('view-grid-add')->collapsable(),

                MenuSection::make(__('Playauto'), [
                    MenuItem::resource(Channel::class)->withBadge(fn () => ModelsChannel::count(), 'info'),
                    MenuItem::resource(PlayautoGood::class)->withBadge(fn () => ModelsPlayautoGood::count(), 'info'),
                    MenuItem::resource(GoodInventorySnapshot::class),
                ])->icon('view-boards')->collapsable(),

                MenuSection::make(__('Tools'), [
                    MenuItem::resource(NaverCategory::class)->withBadge(fn () => ModelsNaverCategory::count(), 'info'),
                    MenuItem::resource(PriceCoefficient::class),
                    MenuItem::resource(ShutdownGood::class)->withBadge(fn () => ModelsShutdownGood::count(), 'info'),
                ])->icon('scissors')->collapsable(),

                MenuSection::make(__('Setting'), [
                    MenuItem::resource(User::class)->withBadge(fn () => ModelsUser::count(), 'info'),
                    MenuItem::resource(Setting::class)->withBadge(fn () => ModelsSetting::count(), 'info'),
                    MenuItem::resource(AlertEmail::class)->withBadge(fn () => ModelsAlertEmail::count(), 'info'),
                    MenuItem::resource(PlayautoCategory::class)->withBadge(fn () => ModelsPlayautoCategory::count(), 'info'),
                    MenuItem::resource(HelpTip::class)->withBadge(fn () => ModelsHelpTip::count(), 'info'),
                ])->icon('cog')->collapsable(),
                MenuSection::make(__('Helpful Links'), [
                    MenuItem::externalLink(__('GitHub'), 'https://github.com/cable8mm/aipro')->openInNewTab(),
                ])->icon('external-link')->collapsable(),
            ];
        });

        // https://nova.laravel.com/docs/v4/customization/menus#appending-prepending-to-the-menu
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
