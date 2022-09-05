<?php

namespace Modules\Blog\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Modules\Blog\Http\Livewire\Site\Layouts\Sidebar;
use Modules\Blog\Http\Livewire\Site\ListPosts;
use Modules\Blog\Http\Livewire\Site\Single;
use Modules\Blog\Repositories\PostRepositoryFirebase;
use Modules\Blog\Repositories\PostRepositoryInterface;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Blog';
    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'blog';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        //        $this->registerFactories();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));

        $router = app()->make('router');

        Livewire::component('blog::site.index', ListPosts::class);
        Livewire::component('blog::site.single', Single::class);
        Livewire::component('blog::site.layouts.sidebar', Sidebar::class);
        /*  if ( ! Schema::hasTable('posts')) {


              return;
          }
          $posts = Post::all();
          $posts->each(fn(Post $post) => $router->get($post->slug, 'Modules\Blog\Http\Controllers\Site\PostsController@show')
                                            ->defaults('slug', $post->slug)
                                            ->name($post->slug)
                                            ->middleware('web'));*/
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
            $sourcePath => $viewPath,
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
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (!(!app()->environment('production') && $this->app->runningInConsole())) {
            return;
        }
        app(Factory::class)->load(module_path($this->moduleName, 'Database/factories'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind(
            PostRepositoryInterface::class,
            PostRepositoryFirebase::class
        );
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
