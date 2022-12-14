<?php

namespace TheBachtiarz\Auth\Repositories;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Sanctum\NewAccessToken;
use TheBachtiarz\Auth\Models\PersonalAccessToken;
use TheBachtiarz\Auth\Models\User;

class PersonalAccessTokenRepository
{
    //

    // ? Public Methods
    /**
     * Get current auth tokens
     *
     * @return Collection<PersonalAccessToken>
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
     * @return PersonalAccessToken
     */
    public function getByName(string $tokenName): PersonalAccessToken
    {
        $this->authenticate();

        $_token = PersonalAccessToken::getOwnTokenByName(Auth::user(), $tokenName)->first();

        if (!$_token) throw new ModelNotFoundException("Token with name '$tokenName' not found");

        return $_token;
    }

    /**
     * Create a new token
     *
     * @param User $user
     * @return NewAccessToken
     */
    public function create(User $user): NewAccessToken
    {
        $this->authenticate();

        $_create = $user->createToken(
            name: Str::uuid()->toString(),
            expiresAt: $user->getTokenExpiresAt()
        );

        return $_create;
    }

    /**
     * Delete token by name
     *
     * @param string $tokenName
     * @return boolean|null
     */
    public function deleteByName(string $tokenName): ?bool
    {
        return $this->getByName($tokenName)->delete();
    }

    // ? Private Methods
    /**
     * Check is authenticated
     *
     * @return void
     * @throws AuthenticationException
     */
    private function authenticate(): void
    {
        if (!Auth::hasUser()) throw new AuthenticationException();
    }

    // ? Setter Modules
}
