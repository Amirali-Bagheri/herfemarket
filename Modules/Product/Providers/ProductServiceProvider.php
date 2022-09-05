<?php

namespace Modules\Product\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Modules\CMS\Repository\Eloquent\BaseRepository;
use Modules\CMS\Repository\EloquentRepositoryInterface;
use Modules\Product\Http\Livewire\Admin\Prices\Prices;
use Modules\Product\Http\Livewire\Admin\Prices\PricesShow;
use Modules\Product\Http\Livewire\Admin\Prices\PricesUpdate;
use Modules\Product\Http\Livewire\Site\Products;
use Modules\Product\Http\Livewire\Site\ProductsShow;
use Modules\Product\Repository\Eloquent\ProductRepository;
use Modules\Product\Repository\ProductRepositoryInterface;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Product';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'product';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        Livewire::component('product::datatable', \Modules\Product\Http\Livewire\Admin\Products\ProductDatatable::class);
        Livewire::component('product::create', \Modules\Product\Http\Livewire\Admin\Products\ProductCreate::class);
        Livewire::component('product::update', \Modules\Product\Http\Livewire\Admin\Products\ProductUpdate::class);
        Livewire::component('product::checker', \Modules\Product\Http\Livewire\Admin\ProductChecker::class);

        Livewire::component('product::prices.datatable', Prices::class);
        Livewire::component('product::prices.update', PricesUpdate::class);
        Livewire::component('product::prices.show', PricesShow::class);

        Livewire::component('product::site.products', Products::class);
        Livewire::component('product::site.product_show', ProductsShow::class);


        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'),
            $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
