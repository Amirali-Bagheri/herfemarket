<?php

namespace Modules\Brand\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Modules\Brand\Http\Livewire\Create;
use Modules\Brand\Http\Livewire\Datatable;
use Modules\Brand\Http\Livewire\Update;

class BrandServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Brand';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'brand';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        Livewire::component('brand::datatable', Datatable::class);
        Livewire::component('brand::create', Create::class);
        Livewire::component('brand::update', Update::class);


        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));

//        $router = app()->make('router');

//        if (Schema::hasTable('brands')) {
//            $brands = Brand::all();
//            $brands->each(function (Brand $brand) use ($router) {
//                $router->get($brand->slug, 'App\Http\Controllers\Site\ProductsController@products')
//                    ->defaults('slug', $brand->slug)
//                    ->name($brand->slug)
//                    ->middleware('web');
//
//                $router->get($brand->title, 'App\Http\Controllers\Site\ProductsController@products')
//                    ->defaults('title', $brand->title)
//                    ->name($brand->title)
//                    ->middleware('web');
//
//            });
//        }
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
