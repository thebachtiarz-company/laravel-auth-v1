<?php

namespace TheBachtiarz\Auth;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use TheBachtiarz\Auth\Helpers\MigrationHelper;
use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;
use TheBachtiarz\Auth\Providers\AppsProvider;

class ServiceProvider extends LaravelServiceProvider
{
    //

    public function register(): void
    {
        /**
         * @var AppsProvider $appsProvider
         */
        $appsProvider = new AppsProvider;

        $appsProvider->registerConfig();

        if ($this->app->runningInConsole()) {
            $this->commands($appsProvider->registerCommands());
        }
    }

    public function boot(): void
    {
        if (app()->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/' . AuthConfigInterface::AUTH_CONFIG_NAME . '.php' => config_path(AuthConfigInterface::AUTH_CONFIG_NAME . '.php'),
            ], 'thebachtiarz-auth-config');

            if (tbauthconfig('migration_remove_status')) {
                $_migrationHelper = new MigrationHelper;

                $_migrationHelper->removeMigrationFiles();
                $_migrationHelper->disableMigrationStatus();

                $this->publishes([
                    __DIR__ . '/../database/migrations' => database_path('migrations'),
                ], 'thebachtiarz-auth-migrations');
            }
        }
    }
}
