<?php

namespace TheBachtiarz\Auth\Providers;

class DataProvider
{
    //

    /**
     * List of config who need to registered into current project.
     * Perform by auth app module.
     *
     * @return array
     */
    public static function registerConfig(): array
    {
        $registerConfig = [];

        // ! auth
        $registerConfig[] = [];

        return $registerConfig;
    }
}