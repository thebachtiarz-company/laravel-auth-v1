<?php

namespace TheBachtiarz\Auth\Repositories;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Sanctum\NewAccessToken;
use TheBachtiarz\Auth\Interfaces\Model\PersonalAccessTokenInterface;
use TheBachtiarz\Auth\Interfaces\Model\UserInterface;
use TheBachtiarz\Auth\Models\PersonalAccessToken;
use TheBachtiarz\Auth\Models\User;

class PersonalAccessTokenRepository extends AbstractRepository
{
    //

    // ? Public Methods
    /**
     * Get current auth tokens
     *
     * @return Collection<PersonalAccessTokenInterface>
     */
    public function get(): Collection
    {
        $this->authenticate();

        $_collection = PersonalAccessToken::getOwnTokens(Auth::user());

        if (!$_collection->count()) throw new ModelNotFoundException("There is no tokens for current auth");

        return $_collection->get();
    }

    /**
     * Get token by name
     *
     * @param string $tokenName
     * @return PersonalAccessTokenInterface
     */
    public function getByName(string $tokenName): PersonalAccessTokenInterface
    {
        $this->authenticate();

        $_token = PersonalAccessToken::getOwnTokenByName(Auth::user(), $tokenName)->first();

        if (!$_token) throw new ModelNotFoundException("Token with name '$tokenName' not found");

        return $_token;
    }

    /**
     * Create a new token
     *
     * @param UserInterface $userInterface
     * @return NewAccessToken
     */
    public function create(UserInterface $userInterface): NewAccessToken
    {
        $this->authenticate();

        /** @var User $userInterface */
        $_create = $userInterface->createToken(
            name: Str::uuid()->toString(),
            expiresAt: $userInterface->getTokenExpiresAt()
        );

        return $_create;
    }

    /**
     * Delete token by name
     *
     * @param string $tokenName
     * @return boolean
     */
    public function deleteByName(string $tokenName): bool
    {
        /** @var PersonalAccessToken $_token */
        $_token = $this->getByName($tokenName);

        return $_token->delete();
    }

    // ? Protected Methods
    /**
     * Check is authenticated
     *
     * @return void
     * @throws AuthenticationException
     */
    protected function authenticate(): void
    {
        if (!Auth::hasUser()) throw new AuthenticationException();
    }

    // ? Setter Modules
}
