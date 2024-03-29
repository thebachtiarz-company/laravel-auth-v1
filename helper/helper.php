<?php

declare(strict_types=1);

use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;

if (! function_exists('tbauthconfig')) {
    /**
     * TheBachtiarz auth config
     *
     * @param string|null $keyName   Config key name | null will return all
     * @param bool|null   $useOrigin Use original value from config
     */
    function tbauthconfig(string|null $keyName = null, bool|null $useOrigin = true): mixed
    {
        $configName = AuthConfigInterface::CONFIG_NAME;

        return tbconfig($configName, $keyName, $useOrigin);
    }
}

if (! function_exists('tbauthmodeluserfillables')) {
    /**
     * Get User model fillable
     *
     * @return array
     */
    function tbauthmodeluserfillables(): array
    {
        return tbauthconfig(AuthConfigInterface::IDENTITY_METHOD, false) === 'email'
            ? UserInterface::ATTRIBUTES_EMAIL_IDENTITY_FILLABLE
            : UserInterface::ATTRIBUTES_USERNAME_IDENTITY_FILLABLE;
    }
}
