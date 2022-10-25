<?php

namespace TheBachtiarz\Auth\Traits\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

/**
 * User Scope Trait
 */
trait UserScopeTrait
{
    //

    // ? Public Methods
    /**
     * Get by identifier
     *
     * @param Builder $builder
     * @param string $identifier
     * @return Builder
     */
    public function scopeGetByIdentifier(Builder $builder, string $identifier): Builder
    {
        $_identifier = tbauthconfig('user_auth_identity_method');

        return $builder->where(DB::raw("BINARY `$_identifier`"), $identifier);
    }

    // ? Private Methods

    // ? Setter Modules
}
