<?php

namespace Modules\Groups\Providers;

use Illuminate\Support\ServiceProvider;

class GroupsServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('Groups', 'Database/Migrations'));
        $this->loadRoutesFrom(module_path('Groups', 'Routes/web.php'));
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
            module_path('Groups', 'Config/config.php') => config_path('groups.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Groups', 'Config/config.php'), 'groups'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/groups');
        $sourcePath = module_path('Groups', 'Resources/views');
        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', 'groups-module-views']);
        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), 'groups');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        // No translations for now
    }

    /**
     * Get the paths to publishable view files.
     *
     * @return array
     */
    protected function getPublishableViewPaths()
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path . '/modules/groups')) {
                $paths[] = $path . '/modules/groups';
            }
        }
        return $paths;
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
