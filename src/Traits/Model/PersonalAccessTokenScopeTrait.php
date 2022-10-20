<?php

namespace TheBachtiarz\Auth\Traits\Model;

use Illuminate\Database\Eloquent\Builder;
use TheBachtiarz\Auth\Interfaces\Model\PersonalAccessTokenInterface;
use TheBachtiarz\Auth\Models\User;

/**
 * Personal Access Token Map Trait
 */
trait PersonalAccessTokenScopeTrait
{
    /**
     * Current Model User data
     *
     * @var User
     */
    protected User $user;

    // ? Public Methods
    /**
     * Get own tokens
     *
     * @param Builder $builder
     * @param User $user
     * @param array $whereCondition
     * @return Builder
     */
    public function scopeGetOwnTokens(Builder $builder, User $user, array $whereCondition = []): Builder
    {
        $this->user = $user;

        return $builder->where($this->whereConditionResolver($whereCondition));
    }

    /**
     * Get token by user model and token name
     *
     * @param Builder $builder
     * @param User $user
     * @param string $tokenName
     * @return Builder
     */
    public function scopeGetOwnTokenByName(Builder $builder, User $user, string $tokenName): Builder
    {
        return $builder->getOwnTokens(
            $user,
            [PersonalAccessTokenInterface::PAT_ATTRIBUTE_NAME => $tokenName]
        );
    }

    // ? Private Methods
    /**
     * Where condition resolver
     *
     * @param array $whereConditionCustom default: []
     * @return array
     */
    private function whereConditionResolver(array $whereConditionCustom = []): array
    {
        return array_merge(
            [
                'tokenable_type' => $this->user->getClassModel()::class,
                'tokenable_id' => $this->user->id
            ],
            $whereConditionCustom
        );
    }
}
