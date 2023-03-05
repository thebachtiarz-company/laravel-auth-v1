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
        $container = \Illuminate\Container\Container::getInstance();

        /** @var AppsProvider $_appsProvider */
        $_appsProvider = $container->make(AppsProvider::class);

        $_appsProvider->registerConfig();

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
            $this->publishes([
                __DIR__ . '/../config/' . AuthConfigInterface::CONFIG_NAME . '.php' => config_path(AuthConfigInterface::CONFIG_NAME . '.php'),
            ], 'thebachtiarz-auth-config');

            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'thebachtiarz-auth-migrations');
        }
    }
}
