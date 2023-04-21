<?php

namespace TheBachtiarz\Auth\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use TheBachtiarz\Auth\Interfaces\Model\TokenResetInterface;
use TheBachtiarz\Auth\Models\TokenReset;
use TheBachtiarz\Base\App\Repositories\AbstractRepository;

class TokenResetRepository extends AbstractRepository
{
    //

    // ? Public Methods
    /**
     * Get by id
     *
     * @param integer $id
     * @return TokenResetInterface
     */
    public function getById(int $id): TokenResetInterface
    {
        $token = TokenReset::find($id);

        if (!$token) throw new ModelNotFoundException("Token reset with id '$id' not found");

        return $token;
    }

    /**
     * Get by token
     *
     * @param string $token
     * @return TokenResetInterface
     */
    public function getByToken(string $token): TokenResetInterface
    {
        $tokenReset = TokenReset::getByToken($token)->first();

        if (!$tokenReset) throw new ModelNotFoundException("Token reset with token '$token' not found");

        return $tokenReset;
    }

    /**
     * Get by user identifier
     *
     * @param string $userIdentifier
     * @return Collection<TokenResetInterface>
     */
    public function getByUserIdentifier(string $userIdentifier): Collection
    {
        $collection = TokenReset::getByUserIdentifier($userIdentifier);

        if (!$collection->count()) throw new ModelNotFoundException("Token reset with user identifier '$userIdentifier' not found");

        return $collection->get();
    }

    /**
     * Create new token reset
     *
     * @param TokenResetInterface $tokenResetInterface
     * @return TokenResetInterface
     */
    public function create(TokenResetInterface $tokenResetInterface): TokenResetInterface
    {
        /** @var Model $tokenResetInterface */
        /** @var TokenResetInterface $create */
        $create = $this->createFromModel($tokenResetInterface);

        if (!$create) throw new ModelNotFoundException("Failed to create token reset");

        return $create;
    }

    /**
     * Save current token reset
     *
     * @param TokenResetInterface $tokenResetInterface
     * @return TokenResetInterface
     */
    public function save(TokenResetInterface $tokenResetInterface): TokenResetInterface
    {
        /** @var Model|TokenResetInterface $tokenResetInterface */
        $token = $tokenResetInterface->save();

        if (!$token) throw new ModelNotFoundException("Failed to save current token reset");

        return $tokenResetInterface;
    }

    /**
     * Delete by id
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteById(int $id): bool
    {
        /** @var Model|TokenResetInterface $token */
        $token = $this->getById($id);

        return $token->delete();
    }

    /**
     * Delete by token
     *
     * @param string $token
     * @return boolean
     */
    public function deleteByToken(string $token): bool
    {
        /** @var TokenResetInterface $_token */
        $_token = $this->getByToken($token);

        return $this->deleteById($_token->getId());
    }

    /**
     * Delete by user identifier
     *
     * @param string $userIdentifier
     * @return boolean
     */
    public function deleteByUserIdentifier(string $userIdentifier): bool
    {
        $tokens = $this->getByUserIdentifier($userIdentifier);

        /** @var TokenResetInterface $token */
        foreach ($tokens->all() ?? [] as $key => $token) {
            $this->deleteById($token->getId());
        }

        return true;
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    // ? Setter Modules
}
