<?php

use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;
use TheBachtiarz\Auth\Model\User;

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
 * Get default/override User Model class
 *
 * @return string
 */
function tbauthgetusermodel(): string
{
    $_defaultClass = User::class;

    try {
        throw_if(
            !tbauthconfig('child_model_user_class'),
            'Exception',
            sprintf("No override '%s' class defined, assume use default '%s' class", $_defaultClass, $_defaultClass)
        );

        throw_if(
            !class_exists(tbauthconfig('child_model_user_class')),
            'Exception',
            sprintf("Class '%s' is not defined", tbauthconfig('child_model_user_class'))
        );

        $_defaultClass = tbauthconfig('child_model_user_class');
    } catch (\Throwable $th) {
    } finally {
        return $_defaultClass;
    }
}
