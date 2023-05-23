<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Providers;

use function app;
use function assert;
use function config;

class AppsProvider
{
    public const COMMANDS = [];

    /**
     * Register config
     */
    public function registerConfig(): void
    {
        $dataProvider = app(DataProvider::class);
        assert($dataProvider instanceof DataProvider);

        foreach ($dataProvider->registerConfig() as $key => $register) {
            config($register);
        }
    }
}
