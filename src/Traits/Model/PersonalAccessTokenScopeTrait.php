<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Traits\Model;

use Illuminate\Database\Eloquent\Builder;
use TheBachtiarz\Auth\Interfaces\Model\PersonalAccessTokenInterface;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;

use function array_merge;

/**
 * Personal Access Token Map Trait
 */
trait PersonalAccessTokenScopeTrait
{
    /**
     * Current Model User data
     */
    protected UserInterface $userEntity;

    // ? Public Methods

    /**
     * Get own tokens
     *
     * @param array $whereCondition
     */
    public function scopeGetOwnTokens(Builder $builder, UserInterface $userInterface, array $whereCondition = []): Builder
    {
        $this->userEntity = $userInterface;

        return $builder->where($this->whereConditionResolver($whereCondition));
    }

    /**
     * Get token by user model and token name
     */
    public function scopeGetOwnTokenByName(Builder $builder, UserInterface $userInterface, string $tokenName): Builder
    {
        return $builder->getOwnTokens(
            $userInterface,
            [PersonalAccessTokenInterface::ATTRIBUTE_NAME => $tokenName],
        );
    }

    // ? Private Methods

    /**
     * Where condition resolver
     *
     * @param array $whereConditionCustom default: []
     *
     * @return array
     */
    private function whereConditionResolver(array $whereConditionCustom = []): array
    {
        return array_merge(
            [
                'tokenable_type' => $this->userEntity->getClassModel()::class,
                'tokenable_id' => $this->userEntity->getId(),
            ],
            $whereConditionCustom,
        );
    }
}
