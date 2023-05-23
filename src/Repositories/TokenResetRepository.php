<?php

declare(strict_types=1);

namespace TheBachtiarz\Auth\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use TheBachtiarz\Auth\Interfaces\Model\TokenResetInterface;
use TheBachtiarz\Auth\Models\TokenReset;
use TheBachtiarz\Base\App\Repositories\AbstractRepository;

use function assert;

class TokenResetRepository extends AbstractRepository
{
    // ? Public Methods

    /**
     * Get by id
     */
    public function getById(int $id): TokenResetInterface
    {
        $token = TokenReset::find($id);

        if (! $token) {
            throw new ModelNotFoundException("Token reset with id '$id' not found");
        }

        return $token;
    }

    /**
     * Get by token
     */
    public function getByToken(string $token): TokenResetInterface
    {
        $tokenReset = TokenReset::getByToken($token)->first();

        if (! $tokenReset) {
            throw new ModelNotFoundException("Token reset with token '$token' not found");
        }

        return $tokenReset;
    }

    /**
     * Get by user identifier
     *
     * @return Collection<TokenResetInterface>
     */
    public function getByUserIdentifier(string $userIdentifier): Collection
    {
        $collection = TokenReset::getByUserIdentifier($userIdentifier);

        if (! $collection->count()) {
            throw new ModelNotFoundException("Token reset with user identifier '$userIdentifier' not found");
        }

        return $collection->get();
    }

    /**
     * Create new token reset
     */
    public function create(TokenResetInterface $tokenResetInterface): TokenResetInterface
    {
        /** @var Model $tokenResetInterface */
        $create = $this->createFromModel($tokenResetInterface);
        assert($create instanceof TokenResetInterface);

        if (! $create) {
            throw new ModelNotFoundException('Failed to create token reset');
        }

        return $create;
    }

    /**
     * Save current token reset
     */
    public function save(TokenResetInterface $tokenResetInterface): TokenResetInterface
    {
        /** @var Model|TokenResetInterface $tokenResetInterface */
        $token = $tokenResetInterface->save();

        if (! $token) {
            throw new ModelNotFoundException('Failed to save current token reset');
        }

        return $tokenResetInterface;
    }

    /**
     * Delete by id
     */
    public function deleteById(int $id): bool
    {
        $token = $this->getById($id);
        assert($token instanceof Model);

        return $token->delete();
    }

    /**
     * Delete by token
     */
    public function deleteByToken(string $token): bool
    {
        $tokenReset = $this->getByToken($token);
        assert($tokenReset instanceof TokenResetInterface);

        return $this->deleteById($tokenReset->getId());
    }

    /**
     * Delete by user identifier
     */
    public function deleteByUserIdentifier(string $userIdentifier): bool
    {
        $tokens = $this->getByUserIdentifier($userIdentifier);

        foreach ($tokens->all() ?? [] as $key => $token) {
            assert($token instanceof TokenResetInterface);
            $this->deleteById($token->getId());
        }

        return true;
    }

    // ? Protected Methods

    // ? Private Methods

    // ? Getter Modules

    // ? Setter Modules
}
