<?php

namespace Modules\FacebookPost\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class FacebookPostServiceProvider extends ServiceProvider
{
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
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('FacebookPost', 'Database/Migrations'));
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
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('FacebookPost', 'Config/config.php') => config_path('facebookpost.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('FacebookPost', 'Config/config.php'), 'facebookpost'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/facebookpost');

        $sourcePath = module_path('FacebookPost', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/facebookpost';
        }, \Config::get('view.paths')), [$sourcePath]), 'facebookpost');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/facebookpost');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'facebookpost');
        } else {
            $this->loadTranslationsFrom(module_path('FacebookPost', 'Resources/lang'), 'facebookpost');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('FacebookPost', 'Database/factories'));
        }
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
