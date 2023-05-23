<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;
use TheBachtiarz\Auth\Providers\AppsProvider;

use function app;
use function assert;
use function config_path;
use function database_path;

class ServiceProvider extends LaravelServiceProvider
{
    public function register(): void
    {
        $appsProvider = app(AppsProvider::class);
        assert($appsProvider instanceof AppsProvider);

        $appsProvider->registerConfig();

        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands(AppsProvider::COMMANDS);
    }

    /**
     * Boot
     */
    public function boot(): void
    {
        if (! app()->runningInConsole()) {
            return;
        }

        $configName  = AuthConfigInterface::CONFIG_NAME;
        $publishName = 'thebachtiarz-auth';

        $this->publishes([__DIR__ . "/../config/$configName.php" => config_path("$configName.php")], "$publishName-config");
        $this->publishes([__DIR__ . '/../database/migrations' => database_path('migrations')], "$publishName-migrations");
    }
}
