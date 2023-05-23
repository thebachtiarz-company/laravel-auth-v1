<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Traits\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use TheBachtiarz\Auth\Interfaces\Model\TokenResetInterface;

/**
 * Token Reset Scope Trait
 */
trait TokenResetScopeTrait
{
    // ? Public Methods

    /**
     * Get by token
     */
    public function scopeGetByToken(Builder $builder, string $token): Builder
    {
        $field = TokenResetInterface::ATTRIBUTE_TOKEN;

        return $builder->where(DB::raw("BINARY `$field`"), $token);
    }

    /**
     * Get by user identifier
     */
    public function scopeGetByUserIdentifier(Builder $builder, string $userIdentifier): Builder
    {
        $field = TokenResetInterface::ATTRIBUTE_USERIDENTIFIER;

        return $builder->where(DB::raw("BINARY `$field`"), $userIdentifier);
    }

    // ? Private Methods

    // ? Setter Modules
}
