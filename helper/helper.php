<?php

use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;

if (!function_exists('tbauthconfig')) {
    /**
     * TheBachtiarz auth config
     *
     * @param string|null $keyName config key name | null will return all
     * @return mixed
     */
    function tbauthconfig(?string $keyName = null): mixed
    {
        $configName = AuthConfigInterface::CONFIG_NAME;

        return iconv_strlen($keyName)
            ? config("{$configName}.{$keyName}")
            : config("{$configName}");
    }
}

if (!function_exists('tbauthmodeluserfillables')) {
    /**
     * Get User model fillable
     *
     * @return array
     */
    function tbauthmodeluserfillables(): array
    {
        return tbconfigvalue('user_auth_identity_method') === 'email'
            ? UserInterface::ATTRIBUTES_EMAIL_IDENTITY_FILLABLE
            : UserInterface::ATTRIBUTES_USERNAME_IDENTITY_FILLABLE;
    }
}
