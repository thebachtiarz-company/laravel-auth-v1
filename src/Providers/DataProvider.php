<?php

namespace TheBachtiarz\Auth\Providers;

use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;
use TheBachtiarz\Base\BaseConfigInterface;

class DataProvider
{
    //

    /**
     * List of config who need to registered into current project.
     * Perform by auth app module.
     *
     * @return array
     */
    public function registerConfig(): array
    {
        $registerConfig = [];

        // ! auth
        $configRegistered = tbbaseconfig(BaseConfigInterface::CONFIG_REGISTERED);
        $registerConfig[] = [
            BaseConfigInterface::CONFIG_NAME . '.' . BaseConfigInterface::CONFIG_REGISTERED => array_merge(
                $configRegistered,
                [
                    AuthConfigInterface::CONFIG_NAME
                ]
            )
        ];

        return $registerConfig;
    }
}
