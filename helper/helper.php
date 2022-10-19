<?php

use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;
use TheBachtiarz\Auth\Interfaces\Model\UserModelInterface;

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
 * TheBachtiarz auth route api file location
 *
 * @return string
 */
function tbauthrouteapi(): string
{
    return base_path('vendor/thebachtiarz-company/laravel-auth-v1/src/routes/auth_api.php');
}

/**
 * Get User model fillable
 *
 * @return array
 */
function tbauthmodeluserfillables(): array
{
    return tbauthconfig('user_auth_identity_method') === 'email'
        ? UserModelInterface::USER_ATTRIBUTES_EMAIL_IDENTITY_FILLABLE
        : UserModelInterface::USER_ATTRIBUTES_USERNAME_IDENTITY_FILLABLE;
}
