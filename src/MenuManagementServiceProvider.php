<?php

namespace Proshore\MenuManagement;

use Illuminate\Support\ServiceProvider;

class MenuManagementServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //Load Package routes, views, migrations
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'menu-management');

        //Publishing
        $this->publishes([
            __DIR__.'/config/proshore.menu-management.php' => config_path('proshore.menu-management.php'),
        ], 'config');
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/menu-management'),
        ], 'views');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('proshore-menu-management', function () {
            return new MenuManagement;
        });
    }
}
