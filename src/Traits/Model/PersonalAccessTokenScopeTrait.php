<?php

namespace TheBachtiarz\Auth\Traits\Model;

use Illuminate\Database\Eloquent\Builder;
use TheBachtiarz\Auth\Interfaces\Model\PersonalAccessTokenInterface;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;

/**
 * Personal Access Token Map Trait
 */
trait PersonalAccessTokenScopeTrait
{
    /**
     * Current Model User data
     *
     * @var UserInterface
     */
    protected UserInterface $userEntity;

    // ? Public Methods
    /**
     * Get own tokens
     *
     * @param Builder $builder
     * @param UserInterface $userInterface
     * @param array $whereCondition
     * @return Builder
     */
    public function scopeGetOwnTokens(Builder $builder, UserInterface $userInterface, array $whereCondition = []): Builder
    {
        $this->userEntity = $userInterface;

        return $builder->where($this->whereConditionResolver($whereCondition));
    }

    /**
     * Get token by user model and token name
     *
     * @param Builder $builder
     * @param UserInterface $userInterface
     * @param string $tokenName
     * @return Builder
     */
    public function scopeGetOwnTokenByName(Builder $builder, UserInterface $userInterface, string $tokenName): Builder
    {
        return $builder->getOwnTokens(
            $userInterface,
            [PersonalAccessTokenInterface::ATTRIBUTE_NAME => $tokenName]
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
                'tokenable_type' => $this->userEntity->getClassModel()::class,
                'tokenable_id' => $this->userEntity->getId()
            ],
            $whereConditionCustom
        );
    }
}
