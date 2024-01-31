<?php

namespace App\Providers;

use App\Models\Shop\Order\Order;
use App\Nova\Content\CategoryNovaResource;
use App\Nova\Content\CommentNovaResource;
use App\Nova\Content\PostNovaResource;
use App\Nova\Content\TaxonomyNovaResource;
use App\Nova\Dashboards\Main;
use App\Nova\GameNet\AccountNovaResource;
use App\Nova\GameNet\GameNovaResource;
use App\Nova\GameNet\GenreNovaResource;
use App\Nova\GameNet\PlatformNovaResource;
use App\Nova\GameNet\PublisherNovaResource;
use App\Nova\GameNet\VolumeNovaResource;
use App\Nova\Home\FaqNovaResource;
use App\Nova\Home\PageNovaResource;
use App\Nova\Home\SlideShowNovaResource;
use App\Nova\Lenses\Customers;
use App\Nova\Media\VideoNovaResource;
use App\Nova\Setting\GatewayNovaResource;
use App\Nova\Setting\SettingNovaResource;
use App\Nova\Shop\Address\AddressNovaResource;
use App\Nova\Shop\Payment\OrderNovaResource;
use App\Nova\Shop\Payment\PaymentNovaResource;
use App\Nova\Shop\Payment\TransactionNovaResource;
use App\Nova\Shop\Product\AttributeNovaResource;
use App\Nova\Shop\Product\BrandNovaResource;
use App\Nova\Shop\Product\ProductNovaResource;
use App\Nova\Shop\Product\SKUNovaResource;
use App\Nova\Support\ContactUsNovaResource;
use App\Nova\Support\TicketNovaResource;
use App\Nova\User\ProfileNovaResource;
use App\Nova\User\UserNovaResource;
use Bolechen\NovaActivitylog\Resources\Activitylog;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Enums\NovaFont;
use Laravel\Nova\Menu\MenuGroup;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use NovaCards\SystemInformationCard\SystemInformationCard;
use Vyuldashev\NovaPermission\Permission;
use Vyuldashev\NovaPermission\Role;

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

        // Rtl support
        Nova::enableRTL();

        // Enable Breadcrumb
        Nova::withBreadcrumbs();

        // Custom font
        Nova::applyFont(NovaFont::YekanBakhFaNum);

        Nova::footer(function () {
            return "تمام حقوق مادی و معنوی برای گیم پردایس محفوظ است";
        });

        // Nova::script('nova', public_path('nova/override.js'));
        // Nova::serving(fn () => Nova::provideToScript(['brandUrl' => config('nova.brand.url')]));

        $this->sidebarMenu();
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

    private function sidebarMenu()
    {
        Nova::mainMenu(function () {
            return [
                // Dashboard
                MenuSection::dashboard(Main::class)->icon('view-grid'),

                // Game net
                MenuSection::make(__('GameNet'), [
                    MenuItem::resource(AccountNovaResource::class),
                    MenuGroup::make(__('More'), [
                        MenuItem::resource(GameNovaResource::class),
                        MenuItem::resource(GenreNovaResource::class),
                        MenuItem::resource(PublisherNovaResource::class),
                        MenuItem::resource(PlatformNovaResource::class),
                        MenuItem::resource(VolumeNovaResource::class),]),
                ])->icon('puzzle')
                    ->collapsable()
                    ->collapsedByDefault()
                    ->canSee(function ($request) {
                        return $request->user()->can('manage gamenet', $this);
                    }),

                // Content
                MenuSection::make(__('Content'), [
                    MenuItem::resource(PostNovaResource::class)->canSee(function ($request) {
                        return $request->user()->can('manage posts', $this);
                    }),
                    MenuItem::resource(CategoryNovaResource::class)->canSee(function ($request) {
                        return $request->user()->can('manage categories', $this);
                    }),
                    MenuItem::resource(TaxonomyNovaResource::class)->canSee(function ($request) {
                        return $request->user()->can('manage categories', $this);
                    }),
                    MenuItem::resource(CommentNovaResource::class)->canSee(function ($request) {
                        return $request->user()->can('manage comments', $this);
                    }),
                ])->icon('document-text')->collapsable(),

                // Shop
                MenuSection::make(__('Shop'), [
                    MenuItem::resource(ProductNovaResource::class),
                    MenuItem::resource(SKUNovaResource::class),
                    MenuItem::lens(UserNovaResource::class, Customers::class),
                    MenuItem::resource(BrandNovaResource::class),
                    MenuItem::resource(AttributeNovaResource::class),
                    MenuGroup::make(__('Accounting'), [
                        MenuItem::resource(OrderNovaResource::class)
                            ->withBadge(fn() => Order::pending()->count(), 'warning'),
                        MenuItem::resource(PaymentNovaResource::class),
                        MenuItem::resource(TransactionNovaResource::class)
                            ->canSee(function ($request) {
                                return $request->user()->can('manage transactions', $this);
                            })
                    ]),
                    MenuGroup::make(__('Shipping'), [
                        MenuItem::resource(AddressNovaResource::class),
                    ])
                ])->icon('shopping-cart')
                    ->collapsable()
                    ->collapsedByDefault()
                    ->canSee(function ($request) {
                        return $request->user()->can('manage shop', $this);
                    }),

                // Users
                MenuSection::make(__('Users'), [
                    MenuItem::resource(UserNovaResource::class),
                    MenuItem::resource(ProfileNovaResource::class),
                    MenuItem::resource(Role::class)->canSee(function ($request) {
                        return $request->user()->can('manage roles', $this);
                    }),
                    MenuItem::resource(Permission::class)->canSee(function ($request) {
                        return $request->user()->can('manage permissions', $this);
                    }),
                ])->icon('users')
                    ->collapsable()
                    ->collapsedByDefault()
                    ->canSee(function ($request) {
                        return $request->user()->can('manage users', $this);
                    }),

                // Support
                MenuSection::make(__('Support'), [
                    MenuItem::resource(ContactUsNovaResource::class),
                    MenuItem::resource(TicketNovaResource::class),
                ])->icon('annotation')
                    ->collapsable()
                    ->collapsedByDefault()
                    ->canSee(function ($request) {
                        return $request->user()->can('support', $this);
                    }),

                // Media
                MenuSection::make(__('Media'), [
                    MenuItem::link(__('Media'), '/media-hub'),
                    MenuItem::resource(VideoNovaResource::class),
                ])->icon('film')
                    ->collapsable()
                    ->collapsedByDefault(),

                // Template
                MenuSection::make(__('Template'), [
                    MenuItem::link(__('Menus'), '/menus'),
                    MenuItem::resource(FaqNovaResource::class),
                    MenuItem::resource(PageNovaResource::class),
                    MenuItem::resource(SlideShowNovaResource::class),
                ])->icon('template')
                    ->collapsable()
                    ->collapsedByDefault(),

                // System
                MenuSection::make(__('System'), [
                    MenuItem::resource(SettingNovaResource::class),
                    MenuItem::resource(GatewayNovaResource::class),

                    MenuGroup::make(__('Seo'), [
                        MenuItem::link(__('Redirect SEO'), '/resources/nova-redirector-seos')
                    ]),

                    MenuGroup::make(__('Developers tool'), [
                        MenuItem::link(__('Backups'), '/backups')
                            ->canSee(function ($request) {
                                return $request->user()->can('backups', $this);
                            }),
                        MenuItem::resource(Activitylog::class)
                            ->canSee(function ($request) {
                                return $request->user()->can('logs', $this);
                            }),
                        MenuItem::link(__('Logs'), '/logs-tool')
                            ->canSee(function ($request) {
                                return $request->user()->can('logs', $this);
                            }),
                    ]),

                ])->icon('cog')
                    ->collapsable()
                    ->collapsedByDefault()
                    ->canSee(function ($request) {
                        return $request->user()->can('manage settings', $this);
                    }),
            ];
        });
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
        Gate::define('viewNova', function ($user) {
            if ($user->hasRole(['super admin', 'admin', 'writer', 'seller'])) {
                return true;
            }

            if ($user->hasRole(['member']))
                return false;

            return false;
        });
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
            \Vyuldashev\NovaPermission\NovaPermissionTool::make(),
            \Outl1ne\NovaMediaHub\MediaHub::make()
                ->withCustomFields(
                    ['description' => __('Description')],
                    overwrite: false
                ),
            \Outl1ne\MenuBuilder\MenuBuilder::make(),

            new \Bolechen\NovaActivitylog\NovaActivitylog(),
            new \Spatie\BackupTool\BackupTool(),
            (new \KABBOUCHI\LogsTool\LogsTool()),
        ];
    }

    /**
     * Register the application's Nova resources.
     *
     * @return void
     */
    protected function resources()
    {
        Nova::resourcesIn(app_path('Nova'));

        Nova::resources([
            \The3LabsTeam\NovaRedirectorSeo\App\Nova\NovaRedirectorSeo::class,
        ]);
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
