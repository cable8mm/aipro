<?php

namespace App\Providers;

use App\Nova\AlertEmail;
use App\Nova\BarcodeCommand;
use App\Nova\Box;
use App\Nova\BoxInventoryHistory;
use App\Nova\BoxManualWarehousing;
use App\Nova\BoxPurchaseOrder;
use App\Nova\BoxSupplier;
use App\Nova\Customer;
use App\Nova\Dashboards\Main;
use App\Nova\Good;
use App\Nova\HelpfulFile;
use App\Nova\HelpTip;
use App\Nova\InventoryHistory;
use App\Nova\Item;
use App\Nova\ItemManualWarehousing;
use App\Nova\Location;
use App\Nova\MismatchedOrderShipment;
use App\Nova\OptionGood;
use App\Nova\OptionGoodOption;
use App\Nova\Order;
use App\Nova\OrderSheetWaybill;
use App\Nova\OrderShipment;
use App\Nova\PromotionCode;
use App\Nova\PurchaseOrder;
use App\Nova\RetailPurchase;
use App\Nova\RetailPurchaseItem;
use App\Nova\SetGood;
use App\Nova\Setting;
use App\Nova\Supplier;
use App\Nova\User;
use App\Nova\Warehouse;
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

                MenuSection::make(__('Items & Boxes'), [
                    MenuItem::resource(Item::class),
                    MenuItem::resource(Box::class),
                ])->icon('qrcode')->collapsable(),

                MenuSection::make(__('Online Order & Shipping'), [
                    MenuItem::resource(OrderSheetWaybill::class),
                    MenuItem::resource(Order::class),
                    MenuItem::resource(OrderShipment::class),
                    MenuItem::resource(MismatchedOrderShipment::class),
                ])->icon('truck')->collapsable(),

                MenuSection::make(__('Offline Purchase'), [
                    MenuItem::resource(RetailPurchase::class),
                    MenuItem::resource(RetailPurchaseItem::class),
                ])->icon('truck')->collapsable(),

                MenuSection::make(__('Purchase Ordering'), [
                    MenuItem::resource(PurchaseOrder::class),
                    MenuItem::resource(BoxPurchaseOrder::class),
                    // MenuItem::resource(PurchaseOrderItem::class),
                    // MenuItem::resource(BoxPurchaseOrderItem::class),
                ])->icon('cube')->collapsable(),

                MenuSection::make(__('Inventory Management'), [
                    MenuItem::resource(ItemManualWarehousing::class),
                    MenuItem::resource(BoxManualWarehousing::class),
                    MenuItem::resource(InventoryHistory::class),
                    MenuItem::resource(BoxInventoryHistory::class),
                ])->icon('eye')->collapsable(),

                MenuSection::make(__('Business Management'), [
                    MenuItem::resource(Supplier::class),
                    MenuItem::resource(BoxSupplier::class),
                    MenuItem::resource(Customer::class),
                ])->icon('phone')->collapsable(),

                MenuSection::make(__('MD'), [
                    MenuItem::resource(Good::class),
                    MenuItem::resource(SetGood::class),
                    MenuItem::resource(OptionGood::class),
                    MenuItem::resource(OptionGoodOption::class),
                    MenuItem::resource(PromotionCode::class),
                ])->icon('shopping-cart')->collapsable(),

                MenuSection::make(__('Tools'), [
                    MenuItem::resource(BarcodeCommand::class),
                    MenuItem::externalLink(__('Print Barcode Commands'), '/barcode-command')->openInNewTab(),
                    MenuItem::resource(HelpfulFile::class),
                ])->icon('scissors')->collapsable(),

                MenuSection::make(__('Services'), [
                    MenuItem::resource(AlertEmail::class),
                    MenuItem::resource(HelpTip::class),
                ])->icon('sparkles')->collapsable(),

                MenuSection::make(__('Setting'), [
                    MenuItem::resource(User::class),
                    MenuItem::resource(Setting::class),
                    MenuItem::resource(Location::class),
                    MenuItem::resource(Warehouse::class),
                ])->icon('cog')->collapsable(),

                MenuSection::make(__('Helpful Links'), [
                    MenuItem::externalLink(__('API'), 'https://aipro.test/docs/api')->openInNewTab(),
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
        return [
            new \Badinansoft\LanguageSwitch\LanguageSwitch,
        ];
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
