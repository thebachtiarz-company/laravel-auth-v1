<?php

namespace TheBachtiarz\Auth;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;
use TheBachtiarz\Auth\Providers\AppsProvider;

class ServiceProvider extends LaravelServiceProvider
{
    //

    /**
     * {@inheritDoc}
     */
    public function register(): void
    {
        /** @var AppsProvider $appsProvider */
        $appsProvider = app(AppsProvider::class);

        $appsProvider->registerConfig();

        if ($this->app->runningInConsole()) {
            $this->commands(AppsProvider::COMMANDS);
        }
    }

    /**
     * Boot
     *
     * @return void
     */
    public function boot(): void
    {
        if (app()->runningInConsole()) {
            $configName = AuthConfigInterface::CONFIG_NAME;
            $publishName = 'thebachtiarz-auth';

            $this->publishes([__DIR__ . "/../config/$configName.php" => config_path("$configName.php")], "$publishName-config");
            $this->publishes([__DIR__ . '/../database/migrations' => database_path('migrations')], "$publishName-migrations");
        }
    }
}
