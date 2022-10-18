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
    'user_auth_identity_method' => "username",

    /*
    |--------------------------------------------------------------------------
    | Class Model User Child
    |--------------------------------------------------------------------------
    |
    | Define the child class which extending the "TheBachtiarz\Auth\Model\User::class".
    | example: "App\Models\User" or \App\Models\User::class.
    | Leave null if not using child class.
    |
    */
    'child_model_user_class' => null,

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
];
