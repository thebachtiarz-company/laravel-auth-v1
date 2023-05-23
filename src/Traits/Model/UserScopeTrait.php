<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Traits\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use TheBachtiarz\Auth\Interfaces\Config\AuthConfigInterface;

use function tbauthconfig;

/**
 * User Scope Trait
 */
trait UserScopeTrait
{
    // ? Public Methods

    /**
     * Get by identifier
     */
    public function scopeGetByIdentifier(Builder $builder, string $identifier): Builder
    {
        $attribute = tbauthconfig(AuthConfigInterface::IDENTITY_METHOD, false);

        return $builder->where(DB::raw("BINARY `$attribute`"), $identifier);
    }

    // ? Private Methods

    // ? Setter Modules
}
