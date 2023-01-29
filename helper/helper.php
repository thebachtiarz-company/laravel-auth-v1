<?php

use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;

/**
 * TheBachtiarz auth config
 *
 * @param string|null $keyName config key name | null will return all
 * @return mixed
 */
function tbauthconfig(?string $keyName = null): mixed
{
    $configName = AuthConfigInterface::AUTH_CONFIG_NAME;

    return iconv_strlen($keyName)
        ? config("{$configName}.{$keyName}")
        : config("{$configName}");
}

/**
 * Get User model fillable
 *
 * @return array
 */
function tbauthmodeluserfillables(): array
{
    return tbauthconfig('user_auth_identity_method') === 'email'
        ? UserInterface::ATTRIBUTES_EMAIL_IDENTITY_FILLABLE
        : UserInterface::ATTRIBUTES_USERNAME_IDENTITY_FILLABLE;
}
