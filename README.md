# laravel-auth-v1
### An Authentication for Laravel Project v1

-------
## Requires
- [laravel/framework](https://github.com/laravel/framework/) v^10.0
- [laravel/sanctum](https://github.com/laravel/sanctum/) v^3.2
- [thebachtiarz-company/laravel-base-v1](https://github.com/thebachtiarz/laravel-base-v1/) v^1.x

## Installation
- composer config (only if you have access)
```bash
composer config repositories.thebachtiarz-company/laravel-auth-v1 git git@github.com:thebachtiarz-company/laravel-auth-v1.git
```

- install repository
```bash
composer require thebachtiarz-company/laravel-auth-v1
```

- vendor publish
```bash
php artisan vendor:publish --provider="TheBachtiarz\Auth\ServiceProvider"
```

- ###### Remove existing users migration in database/migrations directory

- database migration
``` bash
php artisan migrate
```

- application refresh
``` bash
php artisan thebachtiarz:base:app:refresh
```

-------
## Feature

> sek males nulis cak :v
-------
