<?php

return [
    /*
    |--------------------------------------------------------------------------
    | User Authentication Identity Method
    |--------------------------------------------------------------------------
    |
    | Here are method identity for user authentication.
    | Available: [email, username].
    | example: email
    |
    */
    'user_auth_identity_method' => 'email',

    /*
    |--------------------------------------------------------------------------
    | Migration status removal
    |--------------------------------------------------------------------------
    |
    | Here are status condition for run migration removal.
    | Disable if don't want to remove migration's files.
    |
    */
    'migration_remove_status' => true,

    /*
    |--------------------------------------------------------------------------
    | Migration files removal
    |--------------------------------------------------------------------------
    |
    | Here are list of migrations file will be remove.
    | Run when this module is published
    |
    */
    'migration_files_remove' => ['create_users_table'],

    /*
    |--------------------------------------------------------------------------
    | Use route REST API
    |--------------------------------------------------------------------------
    |
    | Here are list the configuration for enable/disable REST API for auth.
    | If you prefer to use your own route, we suggest to disable it.
    |
    */
    'route_service' => true,

    /*
    |--------------------------------------------------------------------------
    | Default new user password
    |--------------------------------------------------------------------------
    |
    | Define default user password.
    |
    */
    'default_user_password' => '',
];
