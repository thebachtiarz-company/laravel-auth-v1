<?php

namespace TheBachtiarz\Auth\Providers;

class AppsProvider
{
    //

    public const COMMANDS = [
        // 
    ];

    /**
     * Register config
     *
     * @return void
     */
    public function registerConfig(): void
    {
        /** @var DataProvider $dataProvider */
        $dataProvider = app(DataProvider::class);

        foreach ($dataProvider->registerConfig() as $key => $register)
            config($register);
    }
}
